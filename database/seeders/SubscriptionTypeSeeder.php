<?php

namespace Database\Seeders;

use App\Models\SubscriptionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptionTypes = [
            'Emerj Pro Monthly',
            'Emerj Pro Yearly',

        ];

        foreach ($subscriptionTypes as $subscriptionType) {
            SubscriptionType::create(['name' => $subscriptionType]);
        }
    }

}
