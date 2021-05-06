<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Model\Manager\SubjectManager;

class SubjectController extends AbstractController
{
    public function __construct(){
        $this->manager = new SubjectManager();
    }

    public function index()
    {
        $subjects = $this->manager->getAll();
        
        return $this->render("home/home.php", [
            "title" => "Accueil",
            "subjects" => $subjects
        ]);
    }

    public function voirSubject($id)
    {
        if($subject = $this->manager->getOneById($id)){
            $messages = $this->manager->getMessagesBySubjectId($id);

            return $this->render("subject/voirSubject.php",
            [
                "title" => $subject->getTitle(),
                "subject" => $subject,
                "messages" => $messages
            ]);
        }
        else{
            return $this->render("errors/404.php");
        }
        
    }

    public function createSubject(){

        if(isset($_POST["submit"])){

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

            if($text && $title){

                $lastid = $this->manager->insertSubject($title);
                $this->manager->insertMessage($lastid, $text);

                return $this->redirectToRoute("subject", "voirSubject", [
                    "id" => $lastid
                ]);
            }
        }
    }

    public function answerSubject($subjectId){

        if(isset($_POST["submit"])){
        
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_STRING);

            if($text){
                $this->manager->insertMessage($subjectId, $text);
            }

            return $this->redirectToRoute("subject", "voirSubject", [
                "id" => $subjectId
            ]);
        }
    }

    public function switchlock($id){

        if(isset($_POST["submit"])){

            $subject = $this->manager->getOneById($id);

            $subject->getIsLocked() ? $this->manager->switchlock($id, false) : $this->manager->switchlock($id, true);
        }

        return $this->redirectToRoute("subject", "voirSubject", [
            "id" => $id
        ]);
    }
}