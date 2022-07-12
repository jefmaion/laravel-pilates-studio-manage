<?php

namespace App\Services;

use App\Models\Registration;

class RegistrationService extends BaseService {


    protected $registration;
    protected $planService;

    public function __construct(Registration $registration, PlanService $planService)
    {
        parent::__construct($registration);
        $this->registration = $registration;

        $this->planService = $planService;
    }





    public function createRegistration($data) {
        $plan = $this->planService->find($data['plan_id']);
        $data['date_end'] = date('Y-m-d', strtotime($data['date_start'] . '+' . $plan->duration . ' months'));
        return $this->create($data);
    }


    public function updateRegistration($data, $id) {
        $plan = $this->planService->find($data['plan_id']);
        $data['date_end'] = date('Y-m-d', strtotime($data['date_start'] . '+' . $plan->duration . ' months'));
        
        return $this->update($data, $id);
    }




}