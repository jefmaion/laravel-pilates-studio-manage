<?php

namespace App\Services;

use App\Models\PaymentMethod;

class PaymentMethodService extends BaseService {

    public function __construct(PaymentMethod $paymentMethod)
    {
        parent::__construct($paymentMethod);
    }

}