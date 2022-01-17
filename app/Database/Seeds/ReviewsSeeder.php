<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class ReviewsSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('Reviews')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE Reviews AUTO_INCREMENT = 1");
        $faker = Factory::create();
        $ReviewsBuilder = $this->db->table('Reviews');

        $Reviews = [
            [   
                "description" => $faker->text,
                "punctuation" =>  $faker->numberBetween('0', '10'),
                "email" => $faker->email(),
                "created_at" => new Time('now'),
                "restaurant_id" => 1
            ],
            [
                "description" => $faker->text,
                "punctuation" =>  $faker->numberBetween('0', '10'),
                "email" => $faker->email(),
                "created_at" => new Time('now'),
                "restaurant_id" => 2
            ]
        ];
        $ReviewsBuilder -> insertBatch($Reviews);
    }
}
