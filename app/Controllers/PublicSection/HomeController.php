<?php

namespace App\Controllers\PublicSection;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function home (){
        $data = array(
            "title" => "Home",
        );
        return view ("PublicSection/home", $data);
    }
}
