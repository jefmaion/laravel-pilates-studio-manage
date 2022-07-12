<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            ['name' => 'Dinheiro'],
            ['name' => 'Pix'],
            ['name' => 'Cartão Crédito'],
            ['name' => 'Cartão Débito'],
            ['name' => 'Transferência'],
        ];

        foreach($payments as $payment) {
            PaymentMethod::create($payment);
        }
    }
}
