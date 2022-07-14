<?php

namespace App\Services;

use App\Models\Classes;

class ClassesService extends BaseService {

    public function __construct(Classes $class)
    {
        parent::__construct($class);
    }

}