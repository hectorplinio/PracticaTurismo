<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class WeatherController extends ResourceController
{
    protected $modelName = 'App\Models\WeatherModel';
    protected $format = "json";
    public function weatherRest()
    {
        try{
            $weather = $this->model->findWeather();
            if ($weather == null){
                return $this->respond($weather,404,"Weather not found");

            }else{
                return $this->respond($weather, 200, "Weather successfully found.");
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(),500,"Internal Error");
        }
    }
}
