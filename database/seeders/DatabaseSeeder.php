<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\Plan;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Student::factory(200)->create();
        Instructor::factory(3)->create();
        $this->call([PlanSeeder::class]);
    }
}
