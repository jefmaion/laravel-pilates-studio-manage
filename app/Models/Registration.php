<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];



    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function weekclasses() {
        return $this->hasMany(RegistrationWeekClass::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
