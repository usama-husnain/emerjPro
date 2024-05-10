<?php

namespace Database\Seeders;

use App\Models\SubscriptionStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptionStatuses = [
            'Active',
            'Cancelled',
            'Locked',
            'Paused',
            'Overdue',
            'Pending Activation',
            'Error',
            'Expired',
            'Pending Cancellation',
            'Soft Delete',
            'Invoice Sent'
        ];

        foreach ($subscriptionStatuses as $subscriptionStatus) {
            SubscriptionStatus::create(['name' => $subscriptionStatus]);
        }
    }

}
