<?php

namespace App\Services;

use App\Models\Student;
use App\Models\User;

class StudentService extends BaseService
{

    protected $student;
    protected $userService;

    public function __construct(Student $student, UserService $userService)
    {   
        parent::__construct($student);
        $this->student = $student;
        $this->userService = $userService;
    }

    public function find($id) {
        return $this->student->with('user')->find($id);
    }


    public function listStudents() {
        return $this->listAll();
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
