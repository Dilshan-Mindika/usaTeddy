<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $clients = [];
        for ($i = 1; $i <= 20; $i++) {
            // Determine if the client is an individual or a business
            $isBusiness = $faker->boolean(50); // 50% chance

            if ($isBusiness) {
                $name = $faker->company;
                $registrationNumber = 'PVT-' . strtoupper(Str::random(8));
                $taxId = 'P' . $faker->numerify('#########') . $faker->randomLetter;
            } else {
                $name = $faker->name;
                $registrationNumber = 'BN-' . strtoupper(Str::random(8));
                $taxId = 'A' . $faker->numerify('#########') . $faker->randomLetter;
            }

            $clients[] = [
                'name' => $name,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'phone_number' => $faker->unique()->phoneNumber,
                'registration_number' => $registrationNumber,
                'tax_id' => $taxId,
                'bank_id' => $faker->numberBetween(1, 10), // Assume you have 10 banks in the `banks` table
                'account_number' => $faker->bankAccountNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('clients')->insert($clients);
    }
}
