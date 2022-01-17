<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RestaurantsSeeder extends Seeder
{
    public function run()
    {
        
        $this->db->table('Restaurants')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE Restaurants AUTO_INCREMENT = 1");
        $RestaurantsBuilder = $this->db->table('Restaurants');
        $Restaurants = [
            [   
                "name" =>"Asador de Antonio",
                "description" =>"Cocina conquense y carne asada al horno de leña en salón de estilo rústico con vigas de madera vista.",
                "address" => "Avenida de Castilla-la Mancha, 3",
                "latitude" =>  "40.070780791578954",
                "longitude" => " -2.1368330843959074",
                "reviewAverage" => "",
                "numReviews" => "",
                "created_at" => new Time('now')

            ],
            [
                "name" =>"Meson Rodriguez",
                "description" =>"Un buen sitio donde comer la verdadera comida de Cuenca.",
                "address" => "Calle San Francisco, 6",
                "latitude" =>  "40.07134189687638",
                "longitude" => "-2.135264974003179",
                "reviewAverage" => "",
                "numReviews" => "",
                "created_at" => new Time('now')
            ]
        ];
        $RestaurantsBuilder -> insertBatch($Restaurants);
    }
}
