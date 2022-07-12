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
                    'duration' => 30,
                    'value' => 154.98
                ],
                [
                    'name' => 'Mensal (2x)',
                    'duration' => 30,
                    'value' => 250
                ],

                [
                    'name' => 'Mensal (3x)',
                    'duration' => 30,
                    'value' => 700
                ]
        ];


        foreach($plans as $plan) {
            Plan::create($plan);
        }


    }
}
