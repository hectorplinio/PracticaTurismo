<?php

namespace App\Models;

use App\Entities\Reviews;
use CodeIgniter\Model;

class ReviewsModel extends Model
{
    protected $table            = 'Reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Reviews::class;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ["description", "punctuation", "email", "restaurant_id"];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
    public function findReviews($id = null){
        
        return $this -> where(['restaurant_id' => $id])
                     ->findAll();
    }
    public function findReviewsId($id = null){
        
        return $this ->where(['id' => $id])
                     ->first();
    }
    public function findRestaurantEmail($id = null,$email = null){
        
        $condition = "email= '$email' AND restaurant_id ='$id'";
        return $this -> where($condition)
                     ->findAll();
    }
    public function AvgRestaurant($id = null){
        return $this ->where(["restaurant_id" => $id])
                    ->selectAvg('punctuation')
                    ->first();
    }
    public function findReviewsDelete($id = null){
        return $this -> where(['id' => $id])
                     ->delete();
    }
    
}
