<?php

namespace App\Models;

use App\Enums\ClassEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Classes extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $weekdayNames = [
        2 => 'Segunda-Feira',
        3 => 'Terça-Feira',
        4 => 'Quarta-Feira',
        5 => 'Quinta-Feira',
        6 => 'Sexta-Feira',
        7 => 'Sábado',
    ];

    protected $classStatusData = [
        ClassEnum::Status_Programmed => 'Aula Agendada',
        ClassEnum::Status_Absensed => 'Falta',
        ClassEnum::Status_AbsensedJustified => 'Falta Justificada',
        'C' => 'Cancelada',
        ClassEnum::Status_Executed => 'Aula Realizada'
    ];

    public function getClassStatusAttribute()
    {

        if (!$this->status) {
            return $this->classStatusData['A'];
        }

        return $this->classStatusData[$this->status];
    }

    

    public function getWeekdayNameAttribute()
    {
        return $this->weekdayNames[date('w', strtotime($this->date)) + 1];
    }

    public function getDateFormatedAttribute()
    {
        return date('d/m/Y', strtotime($this->date));
    }

    public function getExtenseDateAttribute() {
        return $this->getWeekdayNameAttribute() . ', ' .date('d', strtotime($this->date)) .' '.date('M', strtotime($this->date)).' '.date('Y', strtotime($this->date));
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function instructorExecuted()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id_executed');
    }

    public function registration()
    {
        return $this->belongsTo(Student::class);
    }

    public function classParent() {
        return $this->belongsTo(Classes::class, 'class_parent_id');
    }

    // public function classType()
    // {
    //     return $this->belongsTo(ClassType::class);
    // }
}
