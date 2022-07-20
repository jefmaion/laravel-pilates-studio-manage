<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected static function booted()
    // {
    //     static::deleted(function($user) {
    //         $user->user()->delete();
    //     });
    // }


    protected $genderName = [
        'M' => 'Masculino',
        'F' => 'Feminino',
    ];

    public function getAgeAttribute() {
        return Carbon::parse($this->birth_date)->age;
    }

    public function getGenderNameAttribute() {
        return $this->genderName[$this->gender];
    }

    public function student() {
        return $this->hasOne(Student::class);
    }

    public function instructor() {
        return $this->hasOne(Instructor::class);
    }
}
