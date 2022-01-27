<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\WeatherModel;
use CodeIgniter\CLI\CLI;

class WeatherCommand extends BaseController
{
    public function index()
    {
        //
    }
    public function weatherCommand(){
        /* Endpoint */
        $codigoPostal=16003;
        $API="d9f59487133ec8602801f63c12ea676f";
        // https://api.openweathermap.org/data/2.5/weather?zip=16003,es&appid=d9f59487133ec8602801f63c12ea676f
        $url = 'http://api.openweathermap.org/data/2.5/weather?zip='.$codigoPostal.',es&appid='.$API.'';
   
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

        $data=$result['weather'];
        $dataCelsius=$result['main'];
        var_dump($dataCelsius["temp"]);
        $cel = intval($dataCelsius["temp"]);
        $cel = $cel - 273;
        var_dump($cel);
        foreach($dataCelsius as $c){
            CLI::write($c);
        }
        foreach($data as $d){
            CLI::write($d['main']);
            $main =$d['main'];
            $description = $d['description'];
            $icon=$d['icon'];
            $weather = new WeatherModel();
            $data=array(
                "main" => $main,
                "description"=>$description,
                "icon" => $icon,
                "celsius" => $cel
            );
            $weather->save($data);
       curl_close($curl);
   }
}
}