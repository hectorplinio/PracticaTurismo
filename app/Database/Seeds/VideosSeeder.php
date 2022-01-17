<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;


class VideosSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('Videos')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE Videos AUTO_INCREMENT = 1");
        $faker = Factory::create();
        $VideosBuilder = $this->db->table('Videos');

        $Videos = [
            [   
                "title" => $faker->title,
                "description" => $faker->text,
                "pubDate" =>  $faker->dateTimeBetween('-1 year', '+3 years')->format('Y-m-d H:i:s'),
                "url" => $faker->url(),
                "guid" => "",
                "created_at" => new Time('now'),
            ],
            [
                "title" => $faker->title,
                "description" => $faker->text,
                "pubDate" =>  $faker->dateTimeBetween('-1 year', '+3 years')->format('Y-m-d H:i:s'),
                "url" => $faker->url(),
                "guid" => "",
                "created_at" => new Time('now'),
            ]
        ];
        $VideosBuilder -> insertBatch($Videos);
    }
}
