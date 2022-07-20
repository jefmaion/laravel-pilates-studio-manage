<?php

namespace App\Services;

use App\Models\CancelType;


class CancelTypeService extends BaseService {

    public function __construct(CancelType $cancel)
    {
        parent::__construct($cancel);
    }

}