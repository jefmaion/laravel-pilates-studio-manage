<?php

namespace App\Services;

use App\Models\Registration;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class RegistrationService extends BaseService {


    protected $registration;
    protected $planService;
    protected $transactionService;
    protected $classService;

    public function __construct(Registration $registration, PlanService $planService, TransactionService $transactionService, ClassesService $classService)
    {
        parent::__construct($registration);
        $this->registration       = $registration;
        $this->planService        = $planService;
        $this->transactionService = $transactionService;
        $this->classService = $classService;
    }

    


    public function getActiveRegistration($student) {
        return $this->registration->where('student_id', $student->id)->where('status', 'A')->first();
    }

    public function createRegistration($data) {
        $data = $this->prepareRegistrationData($data);
        $registration =  $this->registration->create($data);

        if($registration) {
            $this->saveWeekClasses($registration, $data['week']);
            $this->generateRegistrationClasses($registration, $data);
            $this->generateTransactions($registration);
        }
    }


    public function updateRegistration(Registration $registration, $data) {
        
        $data = $this->prepareRegistrationData($data);

        if($registration->update($data)) {
            $this->saveWeekClasses($registration, $data['week']);
            $this->generateRegistrationClasses($registration, $data);
            $this->generateTransactions($registration);
        }

    }

    public function cancelRegistration(Registration $registration, $data) {
        // return $this->update($data, $id);

        $data['status'] = 'C';
        $data['cancel_date'] = date('Y-m-d H:i:s');



        $registration->update($data);
        $registration->classes()->where('status', 'A')->delete();
        $registration->transactions()->whereNull('is_payed')->forceDelete();

        // $this->updateRegistration($registration, $data);
        

    }


    public function delete($id) {

        $registration = $this->find($id);

        $registration->transactions()->whereNull('is_payed')->forceDelete();
        $registration->classes()->whereNull('status')->forceDelete();
        
        $registration->delete();

    }

    public function saveWeekClasses(Registration $registration, $data) {
        $registration->weekClasses()->delete();
        $registration->weekClasses()->createMany($data);
    }

    public function generateRegistrationClasses(Registration $registration, $data) {

        
        $registration->classes()->delete();

        foreach($registration->weekClasses as $weekClass) {

            $startTime = Carbon::createFromFormat('Y-m-d', $registration->date_start);
            $endTime = Carbon::createFromFormat('Y-m-d', $registration->date_end);
        
            while ($startTime->lt($endTime)) {
                
                if(in_array($startTime->dayOfWeek, [$weekClass->class_weekday-1])){

                    $registration->classes()->create([
                        'date' => $startTime,
                        'time' => $weekClass->class_time,
                        'instructor_id' => $weekClass->instructor_id,
                        'registration_id' => $registration->id,
                        'student_id' => $registration->student_id,
                        'class_type_id' => 1,
                        'status' => 'A'
                    ]);

                }
        
                $startTime->addDay();
            }
        }

    }


    function weekDaysBetween($requiredDays, $start, $end)
    {
        $startTime = Carbon::createFromFormat('Y-m-d', $start);
        $endTime = Carbon::createFromFormat('Y-m-d', $end);
    
        $result = [];
    
        while ($startTime->lt($endTime)) {
            
            if(in_array($startTime->dayOfWeek, $requiredDays)){
                array_push($result, $startTime->copy());
            }
            
            $startTime->addDay();
        }
    
        return $result;
    }


    private function prepareRegistrationData($data) {

        if(!isset($data['plan_id'])) {
            return $data;
        }

        $plan = $this->planService->find($data['plan_id']);
        $data['date_end'] = $this->calculateEndDateRegistration($data['date_start'],$plan->duration);
        return $data;
    }

    private function calculateEndDateRegistration($startDate, $monthsToAdd) {
        return date('Y-m-d', strtotime($startDate . '+' . $monthsToAdd . ' months'));
    }

    private function saveWeekdayClass(Registration $registration, $data) {
        $registration->weekclasses()->delete();
        return $registration->weekclasses()->createMany($data);
    }

    private function generateTransactions(Registration $registration) {

        $registration->transactions()->whereNull('is_payed')->forceDelete();

        $startMonth = Carbon::parse($registration->date_start)->floorMonth();
        $endMonth   = Carbon::parse($registration->date_end)->floorMonth();
        $numMonths  = $startMonth->diffInMonths($endMonth); 

        $transactions = [];
 
        for($i=1; $i<= $numMonths; $i++) {
            $transactions[] = [
                'student_id'  => $registration->student->id,
                'date'        => Carbon::parse($registration->date_start)->addMonths($i),
                'value'       => $registration->final_value,
                'type'        => 1,
                'description' =>  $registration->student->user->name . ' (Mensalidade '.$i.' de '.$numMonths.') ',
            ];
        }

        $registration->transactions()->createMany($transactions);
    }




}