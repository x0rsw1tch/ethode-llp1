<?php

use Illuminate\Database\Seeder;
use App\Idea;

class IdeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $index) {
            $idea = new Idea;
            $idea->idea = $faker->realText($maxNbChars = 90, $indexSize = 2);
            $idea->user_id = 1;
            $idea->ip_address = '10.3.10.3';
            $idea->save();
        }
    }
}
