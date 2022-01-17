<?php

namespace App\Models;

use App\Entities\GasStations;
use CodeIgniter\Model;

class GasStationsModel extends Model
{
    protected $table            = 'GasStations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = GasStations::class;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ["label", "address", "latitude", "longitude", "idees"];

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

    public function findGasStations($id = null){
        if (is_null($id)){
            return $this->findAll();
        }
        return $this -> where(['id' => $id])
                     ->first();
    }
    public function findGasStationsDelete($id = null){
        return $this -> where(['id' => $id])
                     ->delete();
    }
}
