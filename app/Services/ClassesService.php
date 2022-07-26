<?php

namespace App\Services;

use App\Models\Classes;

class ClassesService extends BaseService {

    public function __construct(Classes $class)
    {
        parent::__construct($class);
    }


    public function listStudentClasses($student) {
        return $student->classes();
    }

    public function setPresence(Classes $class, $data) {
        return $class->fill($data)->save();
    }

    public function reschedule(Classes $class, $data) {
        $newClass = $class->replicate();
        $newClass->fill($data);
        return $newClass->save();
    }

}