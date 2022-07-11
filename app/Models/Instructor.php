<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected static function booted()
    {
        static::deleted(function($instructor) {
            $instructor->user()->delete();
        });


        static::restored(function($instructor) {
            $instructor->user()->restore();
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
