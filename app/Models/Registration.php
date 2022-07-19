<?php

namespace App\Models;

use Carbon\Carbon;
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


    public function getLabelStatusAttribute() {
        return ($this->status == 'A') ? 'Ativo' : 'Inativo';
    }

    public function getLabelThemeAttribute() {
        return ($this->status == 'A') ? 'success' : 'secondary';
    }

    public function scopeActive($query) {
        return $query->where('status', 'A');
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function plan() {
        return $this->belongsTo(Plan::class);
    }

    public function weekClasses() {
        return $this->hasMany(RegistrationWeekClass::class);
    }

    

    public function classes() {
        return $this->hasMany(Classes::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function nextPayment() {
        return $this->transactions()->whereNull('is_payed')->first();
    }

    public function getNextPaymentHumanAttribute() {
        $subscription_end = new Carbon($this->nextPayment()->date);
        $left = $subscription_end->subDays(Carbon::now()->diffInDays());
        return $left->diffForHumans();
    }

    public function getExpirationLeftAttribute() {
        $subscription_end = new Carbon($this->date_end);
        $left = $subscription_end->subDays(Carbon::now()->diffInDays());
        return $left->diffForHumans();
    }

    public function getWeekClassByWeekday($wd, $param='') {
        $d = $this->weekClasses()->where('class_weekday', $wd)->first();

        if(!$d) {
            return 0;
        }

        return $d->{$param};
    }
}
