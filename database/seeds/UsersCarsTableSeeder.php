<?php

use App\Entity\Car;
use App\Entity\User;
use Illuminate\Database\Seeder;

class UsersCarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function($u) {
            $u->cars()->save(factory(Car::class)->make());
            $u->cars()->save(factory(Car::class)->make());
            $u->cars()->save(factory(Car::class)->make());
        });
    }
}
