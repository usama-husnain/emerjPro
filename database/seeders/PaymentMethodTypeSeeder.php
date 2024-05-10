<?php

namespace Database\Seeders;

use App\Models\PaymentMethodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethodTypes = [
            'Card',
            'SEPA',
            'Crypto'
        ];

        foreach ($paymentMethodTypes as $paymentMethodType) {
            PaymentMethodType::create(['name' => $paymentMethodType]);
        }
    }
}
