<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Entities\GasStations;
use App\Models\GasStationsModel;
use CodeIgniter\CLI\CLI;

class GasStationsCommand extends BaseController
{
    public function commandUno()
    {
        CLI::write("Hola comando uno");
        //php /Applications/MAMP/htdocs/Codeigniter/PracticaTurismo/public/index.php /commands/commandUno

    }
    public function gasStations(){
         /* Endpoint */
         $url = 'https://sedeaplicaciones.minetur.gob.es/ServiciosRESTCarburantes/PreciosCarburantes/EstacionesTerrestres/';
    
         /* eCurl */
         $curl = curl_init($url);
              
         /* Define content type */
         curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
              
         /* Return json */
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
         
              
         /* make request */
         $result = curl_exec($curl);
         
 
         $result = json_decode($result, true);
         $x =0;
         $data=$result['ListaEESSPrecio'];
        foreach($data as $d){
            $a = $d['Localidad'];
            if ($a == "CUENCA"){
                $gasStation = new GasStationsModel();
                $label = $d['Rótulo'];
                    $address = $d['Dirección'];
                    $latitude = $d['Latitud'];
                    $longitude = $d['Longitud (WGS84)'];
                    $idees = $d['IDEESS'];      
                $station = $gasStation->findGasStationsIdees($idees);
                if($station){
                    $id = $station->id;
                    $data2= array(
                        "id" => $id,
                        "label" => $label,
                        "address" => $address,
                        "latitude" => str_replace(',','.',$latitude),
                        "longitude" => str_replace(',','.',$longitude),
                        "idees" => $idees,
                    );
                    $gasStation->save($data2);
                    CLI::write("Datos guardados con exito");
                }else{
                    $data2= array(
                        "label" => $label,
                        "address" => $address,
                        "latitude" => str_replace(',','.',$latitude),
                        "longitude" => str_replace(',','.',$longitude),
                        "idees" => $idees,
                    );
                    $gasStation->insert($data2);
                    CLI::write("Datos creados con exito");
                }      
            }
        }
        curl_close($curl);
    }
}
