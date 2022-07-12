<?php

namespace App\Services;

use App\Models\Registration;

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


    public function createRegistration($data) {
        $data = $this->prepareRegistrationData($data);
        $registration = $this->create( $data['registration']);

        $this->saveWeekdayClass($registration, $data['weekclass']);
        $this->generateTransactions($registration);
    }


    public function updateRegistration($data, $id) {
        $data = $this->prepareRegistrationData($data);
        $this->update($data['registration'], $id);

        $registration = $this->find($id);
        $this->saveWeekdayClass($registration, $data['weekclass']);
        $this->generateTransactions($registration);
    }




    private function prepareRegistrationData($data) {
        $registrationData = $data['registration'];
        $weekclassData = $data['weekclass'];

        $plan = $this->planService->find($registrationData['plan_id']);
        $registrationData['date_end'] = $this->calculateEndDateRegistration($registrationData['date_start'],$plan->duration);

        $weekclassData = array_filter($weekclassData, function($item) {
            if($item['class_time'] != "" || $item['instructor_id'] != "") {
                return $item;
            }
        });

        return [
            'registration' => $registrationData,
            'weekclass'    => $weekclassData,
        ];
    }

    private function calculateEndDateRegistration($startDate, $monthsToAdd) {
        return date('Y-m-d', strtotime($startDate . '+' . $monthsToAdd . ' months'));
    }

    private function saveWeekdayClass(Registration $registration, $data) {
        $registration->weekclasses()->delete();
        return $registration->weekclasses()->createMany($data);
    }

    private function generateTransactions(Registration $registration) {


        $registration->transactions()->whereNull('is_payed')->delete();

        $date = $registration->date_start;
        $i = 1;
        while($date < $registration->date_end) {

            $registration->transactions()->create([
                'payment_method_id' => $registration->payment_type_id,
                'date' => $date,
                'value' => $registration->final_value,
                'type' => 1,
                'description' => 'Mensalidade '.$i.' de ' . $registration->student->user->name,
            ]);

            $date = date('Y-m-d', strtotime($date . ' +1 months'));
            $i++;
        }
    }




}