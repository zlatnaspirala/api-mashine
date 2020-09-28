<?php

use App\User;
use App\Avatar;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TestAvatarSeeder extends Seeder
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
        $users = factory(User::class, 2)->create()->map(function (User $person) {
            return $person->getKey();
        })->all();

        $user = function () use ($faker, $users) {
            return $faker->randomElement($users);
        };

        $path = '/public/avatar/123456.png';

        /** Gameplay */
        factory(Avatar::class, 1)->create([
            'path' => $path,
            'media_type' => 'image/png', //Storage::disk('local')->mimeType($path),
            'user_id' => $user,
        ])->each(function (Avatar $post) use ($faker, $user) {
        // ])->each(function (Gameplay $post) use ($faker, $user, $tags) {

             \Log::info('COOOLLL.');

        });
    }
}
