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

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function instructor() {
        return $this->belongsTo(Student::class);
    }

    public function registration() {
        return $this->belongsTo(Student::class);
    }
}
