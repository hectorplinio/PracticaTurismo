<?php

namespace App\Database\Seeds;
use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('Roles')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE Roles AUTO_INCREMENT = 1");

        $rolesBuilder = $this->db->table('Roles');

        $roles = [
            [
                "name" => "admin",
                "created_at" => new Time('now')
            ],
            [
                "name" => "public",
                "created_at" => new Time('now')
            ]
        ];
        
        $rolesBuilder -> insertBatch($roles);
    }
}
