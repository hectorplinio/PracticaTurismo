<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class VideosController extends ResourceController
{
    protected $modelName = 'App\Models\VideosModel';
    protected $format = "json";
    
    public function videosRest($id="")
    {
        try{
            if (strcmp($id,"")!==0){
                $videos = $this->model->findVideos($id);
                if ($videos == null){
                    return $this->respond($videos,404,"Video not found");
    
                }else{
                    return $this->respond($videos, 200, "Video ".$id." successfully found.");
                }
    
    
            } else if ($id==null){
                $videos = $this->model->findVideos();
                
                return $this->respond($videos,200,"Videos successfully found.");
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(),500,"Internal Error");
        }
    }
}