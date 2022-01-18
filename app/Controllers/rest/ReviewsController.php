<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class ReviewsController extends ResourceController
{ 
    protected $modelName = 'App\Models\ReviewsModel';
    protected $format = "json";

    public function reviewsRest($restaurants_id="")
    {
        try{
            if (strcmp($restaurants_id,"")!==0){
                $restaurants = $this->model->findReviews($restaurants_id);
                if ($restaurants == null){
                    return $this->respond($restaurants,404,"Restaurant not found");
    
                }else{
                    return $this->respond($restaurants, 200, "Restaurant ".$restaurants_id." successfully found.");
                }
    
    
            } else if ($restaurants_id==""){
                
                return $this->respond("",400,"You dont pass any id restaurant found.");
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(),500,"Internal Error");
        }
    }
    public function reviewsIdRest($id="")
    {
        try{
            if (strcmp($id,"")!==0){
                $restaurants = $this->model->findReviewsId($id);
                if ($restaurants == null){
                    return $this->respond($restaurants,404,"Review not found");
    
                }else{
                    return $this->respond($restaurants, 200, "Review ".$id." successfully found.");
                }
    
    
            } else if ($id==""){
                
                return $this->respond("",400,"You dont pass any id review found.");
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(),500,"Internal Error");
        }
    }
}
