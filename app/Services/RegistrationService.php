<?php

namespace App\Services;

use App\Models\Registration;
use Carbon\Carbon;

class RegistrationService extends BaseService {


    protected $registration;
    protected $planService;
    protected $transactionService;

    public function __construct(Registration $registration, PlanService $planService, TransactionService $transactionService)
    {
        parent::__construct($registration);
        $this->registration       = $registration;
        $this->planService        = $planService;
        $this->transactionService = $transactionService;
    }


    public function getActiveRegistration($student) {
        return $this->registration->where('student_id', $student->id)->where('status', 'A')->first();
    }

    public function createRegistration($student, $data) {
        $data = $this->prepareRegistrationData($data);

        $registration =  $student->registration()->create($data);

        if($registration) {
            $this->generateTransactions($registration);
        }
    }


    public function updateRegistration(Registration $registration, $data) {
        $data = $this->prepareRegistrationData($data);

        if($registration->update($data)) {
            $this->generateTransactions($registration);
        }

    }

    public function cancelRegistration(Registration $registration, $data) {
        // return $this->update($data, $id);

        $data['status'] = 'C';
        $data['cancel_date'] = date('Y-m-d H:i:s');
        $this->updateRegistration($registration, $data);

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
                'description' => '('.$i.' de '.$numMonths.') '  . $registration->student->user->name,
            ];
        }

        $registration->transactions()->createMany($transactions);
    }




}