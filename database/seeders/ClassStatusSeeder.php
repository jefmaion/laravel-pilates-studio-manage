<?php

namespace Database\Seeders;

use App\Models\ClassStatus;
use Illuminate\Database\Seeder;

class ClassStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [

            ['name' => 'Realizada'],
            ['name' => 'Falta'],
            ['name' => 'Falta Justificada']
        ];


    foreach($statuses as $status) {
        ClassStatus::create($status);
    }
    }
}
