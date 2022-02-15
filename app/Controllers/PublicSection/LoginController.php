<?php

namespace App\Controllers\PublicSection;

use App\Controllers\BaseController;
use App\Database\Migrations\Roles;
use App\Libraries\UtilLibrary;
use App\Models\RolesModel;
use App\Models\UsersModel;
use CodeIgniter\I18n\Time;
use Config\UserProfiles;
use Exception;

class LoginController extends BaseController
{
    public function login (){
        $data = array(
            "title" => "Login",
        );
        
        return view ("PublicSection/login", $data);
    }
    public function formulario(){
        try{   
            $request = $this->request;
            $email = $request->getVar('email'); 
            $pass = $request->getVar('password');
            $util = new UtilLibrary();
            $user = new UsersModel();
            $rol = new RolesModel();
            $users = $user->findUsersEmail($email);
            if ($users != null ){
                $pass_hash = $users->password;
                if(password_verify($pass, $pass_hash)){
                    $session = session();
                    $rol = $rol->find($users->rol_id);
                    if ($rol->name ==  "admin"){
                        $rol = UserProfiles::ADMIN_ROLE;
                    }else{
                        $rol = UserProfiles::APP_PUBLIC_ROLE;
                    }
                    $dataSession= [
                        "username" => $users->username,
                        "email" => $users->email,
                        "rol" => $rol,
                        "date" => new Time('now'),
                    ];
                    $session->set($dataSession);
                    $response= $util -> getResponse("OK", "Usuario encontrado", $rol);
                    
                }else{
                    $response= $util -> getResponse("OK", "Usuario encontrado pero contraseña no coincide", "");
                }
            }else{
                    $response= $util-> getResponse("OK", "Usuario no encontrado","");
                    $session = session();
                    $session->destroy();
            }
        } catch(\Exception $e){
            return $util-> getResponse("KO", "Error",$e->getMessage());
        }
        
        return ($response);
    }
}
