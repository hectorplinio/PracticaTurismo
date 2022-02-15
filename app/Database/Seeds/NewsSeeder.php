<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('News')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE News AUTO_INCREMENT = 1");
        $faker = Factory::create();
        $NewsBuilder = $this->db->table('News');

        $News = [
            [   
                "title" => $faker->title(),
                "description" => $faker->text,
                "pubDate" =>  $faker->dateTimeBetween('-1 year', '+3 years')->format('Y-m-d H:i:s'),
                "url" => $faker->url(),
                "guid" => "",
                "created_at" => new Time('now')

            ],
            [
                "title" => $faker->title(),
                "description" => $faker->text,
                "pubDate" =>  $faker->dateTimeBetween('-1 year', '+3 years')->format('Y-m-d H:i:s'),
                "url" => $faker->url(),
                "guid" => "",
                "created_at" => new Time('now')

            ]
        ];
        $NewsBuilder -> insertBatch($News);

    }
}
