<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        $peopleIds = DB::table('clients')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('addresses')->insert([
                'client_id' => $faker->randomElement($peopleIds),
                'type' => $faker->randomElement(['Residential', 'Commercial']),
                'cep' => $faker->postcode,
                'street' => $faker->streetName,
                'number' => $faker->buildingNumber,
                'complement' => $faker->sentence,
                'district' => $faker->citySuffix,
                'state' => $faker->country,
                'city' => $faker->city,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ]);
        }
    }
}
