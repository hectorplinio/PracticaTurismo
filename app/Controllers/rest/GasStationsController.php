<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class GasStationsController extends ResourceController
{
    protected $modelName = 'App\Models\GasStationsModel';
    protected $format = "json";
    public function gasStationsRest($id="")
    {
        try{
            if (strcmp($id,"")!==0){
                $gasStations = $this->model->findGasStations($id);
                if ($gasStations == null){
                    return $this->respond($gasStations,404,"GasStation not found");
    
                }else{
                    return $this->respond($gasStations, 200, "GasStation ".$id." successfully found.");
                }
    
    
            } else if ($id==null){
                $gasStations = $this->model->findGasStations();
                
                return $this->respond($gasStations,200,"All GasStations successfully found.");
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(),500,"Internal Error");
        }
    }
    
}
