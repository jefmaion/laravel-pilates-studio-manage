<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isNull;

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
        'A' => 'Agendada',
        'C' => 'Cancelada',
        'E' => 'Executada'
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

    public function classType()
    {
        return $this->belongsTo(ClassType::class);
    }
}
