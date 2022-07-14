<?php

namespace App\Services;

use App\Models\Student;
use App\Models\User;

class StudentService extends BaseService
{

    protected $student;
    protected $userService;
    protected $classService;

    public function __construct(Student $student, UserService $userService , ClassesService $classService)
    {   
        parent::__construct($student);
        $this->student = $student;
        $this->userService = $userService;
        $this->classService = $classService;
    }


    public function listStudents() {
        return $this->listLasts();
    }

    public function create($data) { 
        $user = $this->userService->create($data['user']);
        return $user->student()->create();
    }

    public function update($data, $id=0) {
        $student = $this->find($id);
        return $student->user()->update($data['user']);
    }
    
    

}
