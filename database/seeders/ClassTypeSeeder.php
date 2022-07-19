<?php

namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Normal', 'initials' => 'AN'],
            ['name' => 'Reposição', 'initials' => 'RP'],
            ['name' => 'Experimental', 'initials' => 'AE']
        ];

        foreach($types as $type) {
            ClassType::create($type);
        }
    }

}
