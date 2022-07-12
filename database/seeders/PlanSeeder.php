<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [

                [
                    'name' => 'Mensal (1x)',
                    'duration' => 1,
                    'value' => 154.98
                ],
                [
                    'name' => 'Mensal (2x)',
                    'duration' => 1,
                    'value' => 250
                ],

                [
                    'name' => 'Mensal (3x)',
                    'duration' => 1,
                    'value' => 300
                ],


                [
                    'name' => 'Bimestral (1x)',
                    'duration' => 2,
                    'value' => 254.98
                ],
                [
                    'name' => 'Bimestral (2x)',
                    'duration' => 2,
                    'value' => 350
                ],

                [
                    'name' => 'Bimestral (3x)',
                    'duration' => 2,
                    'value' => 400
                ],


                [
                    'name' => 'Trimestral (1x)',
                    'duration' => 3,
                    'value' => 454.98
                ],
                [
                    'name' => 'Trimestral (2x)',
                    'duration' => 3,
                    'value' => 550
                ],

                [
                    'name' => 'Trimestral (3x)',
                    'duration' => 3,
                    'value' => 600
                ]
        ];


        foreach($plans as $plan) {
            Plan::create($plan);
        }


    }
}
