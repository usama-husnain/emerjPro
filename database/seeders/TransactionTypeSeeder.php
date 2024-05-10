<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionTypes = [
            'Initial',
            'Recurring',
            'Retry',
            'Refund',
            'Card Update',
            'Custom Payment',
            'Addon',
            'Expired',
            'Pending Cancellation',
            'Soft Delete',
            'Invoice Sent'
        ];

        foreach ($transactionTypes as $transactionType) {
            TransactionType::create(['name' => $transactionType]);
        }
    }
}
