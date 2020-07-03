<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the users table
        DB::table('posts')->truncate();

        // genertae 10 dummy posts data
        $posts = [];
        $faker = Factory::create();
        $date = Carbon::create(2020, 7, 25, 8);
        

        for ($i=1; $i<=10 ; $i++) 
        { 
            $image = "Post_Image_" . rand(1, 5) . ".jpg";
            //date("Y-m-d H:i:s", strtotime("2020-07-3 08:00 +{$i} days"));
            $date->addDays(1);
            $publishedDate = clone($date);

            $posts[] = [
                'author_id'    => rand(1, 3),
                'title'        => $faker->sentence(rand(8, 12)),
                'excert'       => $faker->text(rand(250, 300)),
                'body'         => $faker->paragraphs(rand(10,15), true),
                'slug'         => $faker->slug(),
                'image'        => rand(0, 1) == 1 ? $image : NULL,
                'created_at'   => clone($date),
                'updated_at'   => clone($date),
                'published_at' => $i > 5 && rand(0, 1) == 0 ? NULL : $publishedDate->addDays($i + 4)
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
