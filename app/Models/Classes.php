<?php

namespace App\Models;

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

    public function getWeekdayNameAttribute() {
        return $this->weekdayNames[date('w', strtotime($this->date))+1];
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class);
    }

    public function instructorExecuted() {
        return $this->belongsTo(Instructor::class, 'instructor_id_executed');
    }

    public function registration() {
        return $this->belongsTo(Student::class);
    }
}
