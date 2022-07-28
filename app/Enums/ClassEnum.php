<?php

namespace App\Enums;

final class ClassEnum {

    const Type_NormalClass         = 'AN';
    const Type_RepositionClass     = 'RP';
    const Type_FreeClass           = 'AL';
    const Type_ExperimentalClass   = 'AE';

    const Status_Programmed        = 'AA';
    const Status_Executed          = 'PP';
    const Status_Absensed          = 'FF';
    const Status_AbsensedJustified = 'FJ';

    const Color_Status_Programmed        = 'lightblue';
    const Color_Status_Executed          = 'olive';
    const Color_Status_Absensed          = 'secondary';
    const Color_Status_AbsensedJustified = 'secondary';

    const Type = [

        'AN' => [
            'code'  => 'AN',
            'label' => 'Aula Normal',
            'color' => ''
        ],

        'RP'=> [
            'code'  => 'RP',
            'label' => 'Reposição',
            'color' => ''
        ],

        'AL'=> [
            'code'  => 'AL',
            'label' => 'Aula Avulsa',
            'color' => ''
        ],

        'AE'=> [
            'code'  => 'AE',
            'label' => 'Aula Experimental',
            'color' => ''
        ],

    ];

    const Status = [

        'AA' => [
            'code'  => 'AA',
            'label' => 'Aula Programada',
            'color' => 'info-light'
        ],

        'PP'=> [
            'code'  => 'PP',
            'label' => 'Aula Executada',
            'color' => 'olive-light'
        ],

        'FF'=> [
            'code'  => 'FF',
            'label' => 'Falta (SEM AVISO)',
            'color' => 'danger-light'
        ],

        'FJ'=> [
            'code'  => 'FJ',
            'label' => 'Falta (COM AVISO)',
            'color' => 'danger-light'
        ],

    ];

}