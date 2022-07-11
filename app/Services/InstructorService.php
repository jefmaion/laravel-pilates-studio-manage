<?php

namespace App\Services;

use App\Models\Instructor;


class InstructorService extends BaseService
{

    protected $instructor;
    protected $userService;

    public function __construct(Instructor $instructor, UserService $userService)
    {   
        parent::__construct($instructor);
        $this->instructor = $instructor;
        $this->userService = $userService;
    }


    public function listInstructors() {
        return $this->listLasts();
    }

    public function create($data) { 
        $user = $this->userService->create($data['user']);
        return $user->instructor()->create($data['instructor']);
    }

    public function update($data, $id=0) {
        $instructor = $this->find($id);
        $instructor->update($data['instructor']);

        return $instructor->user()->update($data['user']);
    }


}
