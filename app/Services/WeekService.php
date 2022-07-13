<?php

namespace App\Services;

class WeekService 
{

    private $weekday = [
        ['weekday' => 2, 'week' => 'Segunda-Feira'],
        ['weekday' => 3, 'week' => 'Terça-Feira'],
        ['weekday' => 4, 'week' => 'Quarta-Feira'],
        ['weekday' => 5, 'week' => 'Quinta-Feira'],
        ['weekday' => 6, 'week' => 'Sexta-Feira'],
        ['weekday' => 7, 'week' => 'Sábado'],
    ];

    public function __construct() {
        
    }

    public function find($id) {
        return (object) $this->weekday[($id-2)];
    }

    public function list() {
        return (object) $this->weekday;
    }

}
