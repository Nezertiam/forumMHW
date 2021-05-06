<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Manager\SubjectManager;
use App\Model\Manager\UserManager;

class HomeController extends AbstractController
{
    public function __construct(){
        $this->smanager = new SubjectManager();
        $this->umanager = new UserManager();
    }

    public function index()
    {
        $subjects = $this->smanager->getAll();
        
        return $this->render("home/home.php", [
            "title"           => "Accueil",
            "subjects"        => $subjects
        ]);
    }

    public function user($id){
        if($user = $this->umanager->getOneById($id)){
            return $this->render("home/user.php", [
                "title" => $user->getName(),
                "user" => $user
            ]);
        }
        else{
            return $this->render(
                "errors/404.php"
            );
        }
    }

    public function voirRegles(){
        return $this->render("home/reglement.php", [
            "title" => "Règlement du forum"
        ]);
    }



}