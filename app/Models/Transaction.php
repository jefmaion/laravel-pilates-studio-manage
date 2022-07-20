<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $guarded = [
        'id'
    ];


    public function getValueFormatedAttribute() {
        return number_format($this->value, 2, ",", ".");
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class);
    }

}
