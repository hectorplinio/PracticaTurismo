<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\RestaurantsModel;


class RestaurantsController extends ResourceController
{
    protected $modelName = 'App\Models\RestaurantsModel';
    protected $format = "json";
    public function restaurantsRest($id="")
    {
        try{
            if (strcmp($id,"")!==0){
                $restaurants = $this->model->findRestaurants($id);
                if ($restaurants == null){
                    return $this->respond($restaurants,404,"Restaurant not found");
    
                }else{
                    return $this->respond($restaurants, 200, "Restaurant ".$id." successfully found.");
                }
    
    
            } else if ($id==null){
                $restaurants = $this->model->findRestaurants();
                
                return $this->respond($restaurants,200,"All Restaurants successfully found.");
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(),500,"Internal Error");
        }
    }
}
