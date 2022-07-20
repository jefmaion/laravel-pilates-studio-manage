<?php

namespace Database\Seeders;

use App\Models\CancelType;
use Illuminate\Database\Seeder;

class CancelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cancels = [

                ['name' => 'Preço'],
                ['name' => 'Horário'],
                ['name' => 'Outros']
        ];


        foreach($cancels as $cancel) {
            CancelType::create($cancel);
        }


    }
}
