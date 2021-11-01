<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 0; $i < 100; $i++) {

            DB::table('applications')->insert([
                'name'         => $faker->name(),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
