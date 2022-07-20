<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'user.name' => 'required',
            'user.phone' => 'required',
            'user.birth_date' => 'required'
            // 'user.email' => 'required|email|unique:users,email,'.$id,
        ];
    }

    public function attributes()
    {
        return [
            'user.name' => 'Nome',
            'user.phone' => 'Telefone',
            'user.birth_date' => 'Data de Nascimento'
            
        ];
    }
}
