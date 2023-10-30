<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

use App\Models\Train;

class TrainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // USES FAKER
    public function run(Faker $faker): void
    {
        //USES A FOR LOOP TO ADD 10 ENTRIES ON THE TABLE
        for ($i = 0; $i < 10; $i++) {
            $train = new Train();
            $train->company = $faker->company();
            $train->departure_station = $faker->city();
            $train->departure_time = $faker->dateTimeThisMonth('+10 days');
            $train->arrival_station = $faker->city();
            $train->arrival_time = $faker->dateTimeBetween($train->departure_time, $train->departure_time . '+2 days');
            $train->train_code = $faker->numberBetween(0, 200);
            $train->carriages = $faker->randomDigitNotNull();
            $train->delay = $faker->boolean();
            $train->canceled = $faker->boolean();

            //SAVE THE DATA
            $train->save();
        }
    }
}
