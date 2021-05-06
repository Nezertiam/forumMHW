<?php
namespace App\Controller;

use App\Core\AbstractController;
use App\Core\Session;
use App\Model\Manager\UserManager;
use App\Model\Manager\MessageManager;
use App\Model\Manager\ReportManager;


class AdminController extends AbstractController
{
    public function __construct(){
        Session::get("user") && Session::get("user")->hasRole("GRAND_JAGRAS") ? "" : $this->redirectToRoute("home");
        $this->umanager = new UserManager();
        $this->mmanager = new MessageManager();
        $this->rmanager = new ReportManager();
    }


    public function index(){
        $reports = $this->rmanager->getAll();

        return $this->render("admin/reportList.php", [
            "reports" => $reports
        ]);
    }

    public function goToBanByMessageId($id){

        $message = $this->mmanager->getOneById($id);
        $user = $message->getUser();
        
        return $this->render("admin/ban.php", [
            "user" => $user,
            "message" => $message
        ]);
    }

    public function goToBanByUserId($id){

        $user = $this->umanager->getOneById($id);

        return $this->render("admin/ban.php", [
            "user" => $user
        ]);

    }

    public function banUser($userId){

        $banEnd = filter_input(INPUT_POST, "date", FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"
            ]
        ]);
        $banReason = filter_input(INPUT_POST, "banReason", FILTER_SANITIZE_STRING);
        
        
        if($banEnd && $banReason){

            $dateBanEnd = new \DateTime($banEnd);
            $today = new \DateTime();

            if($dateBanEnd->format("Y") - $today->format("Y") >= 0 && $dateBanEnd->format("m") - $today->format("m") >= 0 && $dateBanEnd->format("d") - $today->format("d") >= 1){

                $this->umanager->banUntil($banEnd, $banReason, $userId);

                if(date_diff($dateBanEnd, $today)->format("%a") == "0"){
                    Session::addFlash("success", "Utilisateur banni jusqu'à minuit");
                }else Session::addFlash("success", "Utilisateur banni pour ".(date_diff($dateBanEnd, $today)->format("%a") + 1)." jours");

                return $this->redirectToRoute("admin");

            }
            else{
                Session::addFlash("error", "La date de bannissement ne peut être antiérieure à celle d'ajourd'hui");
                return $this->redirectToRoute("admin");
            }
        }
        Session::addFlash("error", "Mauvaise syntaxe");
        return $this->redirectToRoute("admin");
    }

    public function removeReport($id){

        $this->rmanager->deleteReport($id);

        return $this->redirectToRoute("admin");
    }


}