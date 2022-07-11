<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends UserRequest

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
        // $student = Student::find($this->student);

        // $id = ($student) ? $student->user->id : 0;
        
        // return [
        //     'user.name' => 'required',
        //     'user.phone' => 'required',
        //     'user.birth_date' => 'required'
        //     // 'user.email' => 'required|email|unique:users,email,'.$id,
        // ];
    }
}
