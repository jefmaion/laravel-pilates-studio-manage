<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
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

    protected function prepareForValidation()
    {

        if(!$this->week)  {
            return;
        }

        $filtered = [];
        foreach($this->week as $key => $week) {
            if(!$week['class_time'] && !$week['instructor_id']) {
                continue;
            }

            $filtered[$key] = $week;
        }

        $this->merge([
            'week' => $filtered
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = Request::segment(2);
        
        return [
            'student_id' => [
                'required', 
                Rule::unique('registrations')->where(function($query) {
                    return $query->where('status', 'A')->whereNull('deleted_at');
                })->ignore($id)
            ],
            'plan_id' => 'required',
            'date_start' => 'required',
            'status' => 'required',
            'class_per_week' => 'required|max:6',
            'week' => 'array|min:'.$this->class_per_week.'|max:'.$this->class_per_week,
            'week.*.class_time' => 'required_with:week.*.instructor_id',
            'week.*.instructor_id' => 'required_with:week.*.class_time'
        ];
    }

    public function attributes()
    {
        return [
            'plan_id' => 'Plano',
            'class_per_week' => 'Aulas por Semana',
            
        ];
    }

    public function messages() {
        return [
            'student_id.required' => 'Selecione o aluno',
            'student_id.unique' => 'Já existe uma matrícula para esse aluno',
            'week.min' => 'Selecione o horário e o professor para as aulas',

            'week.*.class_time.required_with' => 'Selecione o Horário',
            'week.*.instructor_id.required_with' => 'Selecione o Professor',
        ];
    }
}
