<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Core\Session;
use App\Model\Manager\MessageManager;
use App\Model\Manager\ReportManager;
use App\Model\Manager\UserManager;

class ReportController extends AbstractController
{

    public function __construct(){
        if(!Session::isLogged()){return $this->render("home/home.php", ["title" => "Accueil"]);}
        $this->mmanager = new MessageManager();
        $this->rmanager = new ReportManager();
        $this->umanager = new UserManager();
    }

    public function reportMessage($id){

        $message = $this->mmanager->getOneById($id);

        if(isset($_POST["submit"])){

            $reportReason = filter_input(INPUT_POST, "reportReason", FILTER_SANITIZE_STRING);

            $askingUserId = Session::get("user")->getId();
            $reason = $reportReason ? $reportReason : "Champ non renseigné";
            $reportedUserId = $message->getUser()->getId();

            if($this->rmanager->insertReport($askingUserId, $reportedUserId, $reason, $id)){
                Session::addFlash("success", "Merci ! Votre demande a bien été prise en compte");
            } else Session::addFlash("error", "Désolé, une erreur est survenue. Veuillez réessayer");

            return $this->redirectToRoute("home");
        }
        else{
            

            return $this->render("reports/report.php", [
                "title" => "Signaler ".$message->getUser()->getName(),
                "message" => $message,
                "reportedUser" => $message->getUser()
            ]);    
        }
    }



    
    public function reportUser($id){

        if(isset($_POST["submit"])){

            $reportReason = filter_input(INPUT_POST, "reportReason", FILTER_SANITIZE_STRING);

            $askingUserId = Session::get("user")->getId();
            $reason = $reportReason ? $reportReason : "Champ non renseigné";
            $reportedUserId = $this->umanager->getOneById($id)->getId();

            if($this->rmanager->insertReport($askingUserId, $reportedUserId, $reason)){
                Session::addFlash("success", "Merci ! Votre demande a bien été prise en compte");
            } else Session::addFlash("error", "Désolé, une erreur est survenue. Veuillez réessayer");

            return $this->redirectToRoute("home");
        }
        else{
            $user = $this->umanager->getOneById($id);

            return $this->render("reports/report.php", [
                "title" => "Signaler ".$user->getName(),
                "reportedUser" => $user
            ]);    
        }
    }
}