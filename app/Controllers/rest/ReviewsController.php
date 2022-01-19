<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use App\Entities\Restaurants;
use App\Entities\Reviews;
use App\Libraries\UtilLibrary;
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
            else if($email=="" or $email == null){
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
            $restaurant = new RestaurantsModel();

            if(isset($body->id)){
                $reviews = $review->findReviewsId($body->id);
                if ($reviews) {
                    $review->save($body);
                    $restaurants= $restaurant->findRestaurants($body->restaurant_id);
                    $punctuation = $review->AvgRestaurant($body->restaurant_id);
                    $numReviews = $review->findReviews($body->restaurant_id);    
                    $data2 = array(
                        "id" => $restaurants->id,
                        "name" => $restaurants->name,
                        "description" => $restaurants->description,
                        "address" => $restaurants->address,
                        "latitude" => floatval($restaurants->latitude),
                        "longitude" => floatval($restaurants->longitude),
                        "reviewAverage" => $punctuation->punctuation,
                        "numReviews" => count($numReviews)
                    );
                    $resta = new Restaurants($data2);
                    $restaurant->save($resta);
                    return $this->respond("",200,"Review update correctly ");
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
                    $restaurants= $restaurant->findRestaurants($body->restaurant_id);
                    $review->save($newReview);
                    $punctuation = $review->AvgRestaurant($body->restaurant_id);
                    $numReviews = $review->findReviews($body->restaurant_id);    
                    $data2 = array(
                        "id" => $restaurants->id,
                        "name" => $restaurants->name,
                        "description" => $restaurants->description,
                        "address" => $restaurants->address,
                        "latitude" => floatval($restaurants->latitude),
                        "longitude" => floatval($restaurants->longitude),
                        "reviewAverage" => $punctuation->punctuation,
                        "numReviews" => count($numReviews)
                    );
                    $resta = new Restaurants($data2);
                    $restaurant->save($resta);
                    $this->respond("", 200, 'Review add correctly');  
                }else{
                    return $this->respond("",400,"You dont send some data");
    
                }
            } 
            
        }catch(\Exception $e){
            return $this->respond($e->getMessage(),500,"Error del servidor");
        }
        
    }
    public function reviewsDeleteRest() {
        // try{
        //     $request=$this->request;
        //     $body=$request->getJSON();
        //     $id = $body->id;
        //     $review = new ReviewsModel();
        //     if (strcmp($id,"")!==0){
        //         return $this-> respond("",400, "You dont pass any id");
        //     }
        //     $reviews = $review->findReviewsDelete($id);
        //     if ($reviews){
        //         return $this-> respond("",200, "Review deleted correctly");
        //     }else{
        //         return $this-> respond("",404,"Categoria no se ha podido eliminado");

        //     }
        // }catch(\Exception $e){
        //     return $this->respond($e->getMessage(),500,"Error del servidor");

        // }
        try{
            $request=$this->request;
            $body=$request->getJSON();
            $reviewM = new ReviewsModel();
            if(isset($body->id)){
                $review = $reviewM->findReviews($body->id);
                if ($review){
                    $review = $reviewM->findReviewsDelete($body->id);
                    return $this->respond("", 200, $body->id." successfully deleted.");
                }else{
                    return $this->respond("",404,$body->id." not found for deleted");
                }
            } else { 
                return $this->respond("",400,"You dont pass any id  found.");
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(),500,"Internal Error");
        }
        
    }
}
