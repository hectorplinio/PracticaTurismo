<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('Users')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE Users AUTO_INCREMENT = 1");
        $faker = Factory::create();
        $usersBuilder = $this->db->table('Users');
        $password="1234";
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $users = [
            [   
                "username" => "admin",
                "email" => $faker->email,
                "password" =>  $password_hash ,
                "name" => $faker->name,
                "surname" => $faker->name,
                "created_at" => new Time('now'),
                "rol_id" => 1
            ],
            [
                "username" => "public",
                "email" => $faker->email,
                "password" =>  $password_hash ,
                "name" => $faker->name,
                "surname" => $faker->name,
                "created_at" => new Time('now'),
                "rol_id" => 2
            ]
        ];
        $usersBuilder -> insertBatch($users);
    }
}
