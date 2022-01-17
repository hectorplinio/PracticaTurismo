<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class WeatherSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('Weather')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE Weather AUTO_INCREMENT = 1");
        $faker = Factory::create();
        $WeatherBuilder = $this->db->table('Weather');

        $Weather = [
            [   
                "main" => "Rain",
                "description" => $faker->text,
                "icon" =>  $faker->imageUrl(),
                "created_at" => new Time('now'),
            ],
            [
                "main" => "Sun",
                "description" => $faker->text,
                "icon" =>  $faker->imageUrl(),
                "created_at" => new Time('now'),
            ]
        ];
        $WeatherBuilder -> insertBatch($Weather);
    }
}
