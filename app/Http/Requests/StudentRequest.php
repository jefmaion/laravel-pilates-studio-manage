<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $student = Student::find($this->student);

        $id = ($student) ? $student->user->id : 0;
        
        return [
            'user.name' => 'required',
            'user.zipcode' => 'required',
            'user.gender' => 'required',
            'user.email' => 'required|email|unique:users,email,'.$id,
        ];
    }
}
