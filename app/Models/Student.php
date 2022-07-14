<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected static function booted()
    {
        static::deleted(function($student) {
            $student->user()->delete();
        });


        static::restored(function($student) {
            $student->user()->restore();
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function classes() {
        return $this->hasMany(Classes::class);
    }
}
