<?php
namespace App\Libraries;

class UtilLibrary {
    public function getResponse($status="", $message="",$data=""){
        $response = array(
            "status" => $status,
            "message" => $message,
            "data" => $data
        );
        return json_encode($response);
    }
}

?>