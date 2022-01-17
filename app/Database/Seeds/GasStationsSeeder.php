<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class GasStationsSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('GasStations')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE GasStations AUTO_INCREMENT = 1");
        $GasStationsBuilder = $this->db->table('GasStations');
        $GasStations = [
            [   
                "label" =>"Estación de Servicio Repsol",
                "address" => "Calle de los Hermanos Becerril, 2",
                "latitude" =>  "40.06582552889834",
                "longitude" => "-2.1344426469813147",
                "idees" => "",
                "created_at" => new Time('now')

            ],
            [
                "label" =>"Estación de Servicio Cepsa",
                "address" => "Calle Fermin Caballero, 19",
                "latitude" =>  "40.06751398443031",
                "longitude" => "-2.1351025132794934",
                "idees" => "",
                "created_at" => new Time('now')
            ]
        ];
        $GasStationsBuilder -> insertBatch($GasStations);
    }
}
