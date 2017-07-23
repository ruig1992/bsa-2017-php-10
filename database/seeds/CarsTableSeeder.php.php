<?php

use App\Entity\Car;
use Illuminate\Database\Seeder;

class CarsTableSeeder.php extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Car::class)->create(['user_id' => 1]);
        factory(Car::class)->create(['user_id' => 1]);
        factory(Car::class)->create(['user_id' => 1]);

        factory(Car::class)->create(['user_id' => 2]);
    }
}
