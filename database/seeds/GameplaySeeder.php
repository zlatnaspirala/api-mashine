<?php

use App\User;
use App\Gameplay;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Collection;

class GameplaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Faker $faker */
        $faker = app(Faker::class);

        /** @var array $users */
        $users = factory(User::class, 5)->create()->map(function (User $person) {
            return $person->getKey();
        })->all();

        $user = function () use ($faker, $users) {
            return $faker->randomElement($users);
        };

        /** Gameplay */
        factory(Gameplay::class, 10)->create([
            'author_id' => $user,
        ])->each(function (Gameplay $post) use ($faker, $user) {
        // ])->each(function (Gameplay $post) use ($faker, $user, $tags) {

          \Log::info('This is some useful information.');

        });
    }
}
