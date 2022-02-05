<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class NewsController extends ResourceController
{
    protected $modelName = 'App\Models\NewsModel';
    protected $format = "json";
    
    public function newsRest($id="")
    {
        
            try{
                if (strcmp($id,"")!==0){
                    $news = $this->model->findNews($id);
                    if ($news == null){
                        return $this->respond($news,404,"New not found");
        
                    }else{
                        return $this->respond($news, 200, "New ".$id." successfully found.");
                    }
        
        
                } else if ($id==null){
                    $news = $this->model->findNews();
                    
                    return $this->respond($news,200,"News successfully found.");
                }
            }catch(\Exception $e){
                return $this->respond($e->getMessage(),500,"Internal Error");
            }
        
    }
}
