<?php

namespace App\Models;

use App\Entities\Weather;
use CodeIgniter\Model;

class WeatherModel extends Model
{
    protected $table            = 'Weather';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Weather::class;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ["main", "description", "icon"];

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
    public function findWeather($id = null){
        if (is_null($id)){
            return $this->findAll();
        }
        return $this -> where(['id' => $id])
                     ->first();
    }
}
