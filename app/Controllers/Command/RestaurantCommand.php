<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\RestaurantsModel;
use CodeIgniter\CLI\CLI;

class RestaurantCommand extends BaseController
{
    public function index()
    {
        //
    }
    public function restaurantCommand(){
        /* Endpoint */
        $url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/restaurant.json?access_token=pk.eyJ1IjoiaGVjdG9ycGxpbmlvIiwiYSI6ImNrejQ3cDc2ZTBjbHEyb3J4MzMzZHpmMWMifQ.XT3g3xJFTaNGxYeMBtBoaQ&bbox=-2.2827%2C40.0285%2C-2.067%2C40.1178&limit=100';
    
        /* eCurl */
        $curl = curl_init($url);
             
        /* Define content type */
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
             
        /* Return json */
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
             
        /* make request */
        $result = curl_exec($curl);
        

        $result = json_decode($result, false);
        $data=$result->features;
       foreach($data as $d){
           $address = $d->properties->address;
           $latitude= $d->center[0];
           $longitude= $d->center[1];
           $name= $d->text;
           $description= $d->place_name;
           $restaurant = new RestaurantsModel();
           
            $resta = $restaurant->findRestaurantsName($name);
            if ($resta){
                $id = $resta->id;
                $data2= array(
                    "id" => $id,
                    "name" => $name,
                    "description" => $description,
                    "address" => $address,
                    "latitude" => str_replace(',','.',$latitude),
                    "longitude" => str_replace(',','.',$longitude),
                    "image_url" => "https://media-cdn.tripadvisor.com/media/photo-s/17/75/3f/d1/restaurant-in-valkenswaard.jpg"
                    );
                    $restaurant->save($data2);
                    CLI::write("Data of restaurant save sucessfull");

            }else{
                $data2= array(
                    "name" => $name,
                    "description" => $description,
                    "address" => $address,
                    "latitude" => str_replace(',','.',$latitude),
                    "longitude" => str_replace(',','.',$longitude),
                    "image_url" => "https://www.gentleman.excelsior.com.mx/wp-content/uploads/2019/03/G-BARRAS-01-1-1080x675.jpg"
                    );
                    $restaurant->save($data2);
                    CLI::write("Data of restaurant created sucessfull");
            }


    }
    curl_close($curl);

}
public function barCommand(){
    /* Endpoint */
    $url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/bar.json?access_token=pk.eyJ1IjoiaGVjdG9ycGxpbmlvIiwiYSI6ImNrejQ3cDc2ZTBjbHEyb3J4MzMzZHpmMWMifQ.XT3g3xJFTaNGxYeMBtBoaQ&bbox=-2.2827%2C40.0285%2C-2.067%2C40.1178&limit=100';

    /* eCurl */
    $curl = curl_init($url);
         
    /* Define content type */
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
         
    /* Return json */
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
         
    /* make request */
    $result = curl_exec($curl);
    

    $result = json_decode($result, false);
    $data=$result->features;
   foreach($data as $d){
       $address = $d->properties->address;
       $latitude= $d->center[0];
       $longitude= $d->center[1];
       $name= $d->text;
       $description= $d->place_name;
       $restaurant = new RestaurantsModel();
       
        $resta = $restaurant->findRestaurantsName($name);
        if ($resta){
            $id = $resta->id;
            $data2= array(
                "id" => $id,
                "name" => $name,
                "description" => $description,
                "address" => $address,
                "latitude" => str_replace(',','.',$latitude),
                "longitude" => str_replace(',','.',$longitude),
                "image_url" => "https://www.gentleman.excelsior.com.mx/wp-content/uploads/2019/03/G-BARRAS-01-1-1080x675.jpg"
                );
                $restaurant->save($data2);
                CLI::write("Data of bar save sucessfull");

        }else{
            $data2= array(
                "name" => $name,
                "description" => $description,
                "address" => $address,
                "latitude" => str_replace(',','.',$latitude),
                "longitude" => str_replace(',','.',$longitude),
                "image_url" => "https://www.gentleman.excelsior.com.mx/wp-content/uploads/2019/03/G-BARRAS-01-1-1080x675.jpg"
                );
                $restaurant->save($data2);
                CLI::write("Data of bar created sucessfull");
        }


}
curl_close($curl);

}
}
