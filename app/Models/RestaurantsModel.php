<?php

namespace App\Models;

use App\Entities\Restaurants;
use CodeIgniter\Model;

class RestaurantsModel extends Model
{
    protected $table            = 'Restaurants';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Restaurants::class;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ["name", "description", "address", "latitude", "longitude", "image_url", "reviewAverage", "numReviews"];

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
    public function findRestaurants($id = null){
        if (is_null($id)){
            return $this->findAll();
        }
        return $this -> where(['id' => $id])
                     ->first();
    }
    public function findRestaurantsName($name = null){
        if (is_null($name)){
            return $this->findAll();
        }
        return $this -> where(['name' => $name])
                     ->first();
    }
    public function AVG($id = null){
        $condition = "SELECT AVG(punctuation) WHERE restaurant_id ='$id'";
        return $this ->where($condition);
    }
}
