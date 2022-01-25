<?php

namespace App\Models;

use App\Entities\Videos;
use CodeIgniter\Model;

class VideosModel extends Model
{
    protected $table            = 'Videos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Videos::class;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ["title", "description", "pubDate", "url", "guid"];

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
    public function findVideos($id = null){
        if (is_null($id)){
            return $this->findAll();
        }
        return $this -> where(['id' => $id])
                     ->first();
    }
    public function getDateInputFormat($date){
        return date('Y-m-d H:i:s', strtotime($date));
    }
    public function findVideosGuid($guid = null){
        return $this -> where(['guid' => $guid])
                     ->first();
    }
}
