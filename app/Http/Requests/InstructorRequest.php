<?php

namespace App\Http\Requests;

use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends UserRequest

{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return parent::rules();

        // $instructor = Instructor::find($this->student);

        // $id = ($instructor) ? $instructor->user->id : 0;
        
        // return [
        //     'user.name' => 'required',
        //     'user.gender' => 'required',
        //     'user.phone' => 'required'
        //     // 'user.email' => 'required|email|unique:users,email,'.$id,
        // ];
    }
}
