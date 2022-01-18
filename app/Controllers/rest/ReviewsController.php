<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use App\Entities\Reviews;
use App\Models\RestaurantsModel;
use App\Models\ReviewsModel;
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
    public function reviewsRestaurantEmailRest($restaurants_id="", $email="")
    {
        try{
            if($restaurants_id==""){
                return $this->respond("",400,"You dont pass any id restaurant  found.");
            }
            if($email==""){
                return $this->respond("",400,"You dont pass any email found.");
            }
            if (strcmp($restaurants_id,"")!==0){
                $restaurants = $this->model->findRestaurantEmail($restaurants_id, $email);
                if ($restaurants == null){
                    return $this->respond($restaurants,404,"Reviews id not found");
    
                }else{
                    return $this->respond($restaurants, 200, "Reviews ".$restaurants_id." and ".$email." successfully found.");
                }
    
    
            } else {
                
                return $this->respond("",400,"You dont pass any id restaurant or email found.");
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(),500,"Internal Error");
        }
    }
    public function reviewsUpdateRest() {
        try{
            $request=$this->request;
            $body=$request->getJSON();
            $review = new ReviewsModel();
            if(isset($body->id)){
                $reviews = $review->findReviewsId($body->id);
                if ($reviews) {
                    $review->save($body);
                    return $this->respond("",200,"Review update correctly");
                } else {
                    if($body->restaurant_id){
                        return $this->respond("",404,"Review and restaurant_id not found.");
                    }else{
                        return $this->respond("",404,"Review not found.");
                    }
                }

            } else {
                if (isset($body->restaurant_id) && isset($body->email) && isset($body->description) && isset($body->punctuation)){
                    $data = array(
                        "restaurant_id" => $body->restaurant_id,
                        "email" => $body->email,
                        "description" => $body->description,
                        "punctuation" => $body->punctuation
                    );
                    $newReview = new Reviews($data);
                    $punctuation = new RestaurantsModel();
                    $avg= $review->AVG($body->restaurant_id);
                    $review->save($newReview);
                    $this->respond("", 200, 'Review creada con exito '.$avg.'');  
                }else{
                    return $this->respond("",400,"Falta algun dato");
    
                }
            } 
            
        }catch(\Exception $e){
            return $this->respond($e->getMessage(),500,"Error del servidor");
        }
        
    }
}
