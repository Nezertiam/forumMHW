<?php

namespace App\Model\Manager;

use App\Core\AbstractManager;
use App\Core\ManagerInterface;
use App\Core\Session;

class SubjectManager extends AbstractManager implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getAll(){
        return $this->getResults(
            "App\Model\Entity\Subject",
            "SELECT * FROM sujets"
        );
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Subject",
            "SELECT * FROM sujets WHERE id = :num",
            [
                "num" => $id
            ]
        );
    }

    public function getMessagesBySubjectId($id){
        return $this->getResults(
            "App\Model\Entity\Message",
            "SELECT * FROM message WHERE subject_id = :num",
            [
                "num" => $id
            ]
        );
    }

    public function insertMessage($subject_id, $message){
        $req1 = $this->executeQuery(
            "INSERT INTO message (text, user_id, subject_id) VALUES (:text, :user, :subject)",
            [
                "text"  => $message,
                "user" => Session::get("user")->getId(),
                "subject" => $subject_id
            ]
        );

        if($req1 == true){
            $this->executeQuery(
                "UPDATE subject SET lastMessageDate = CURRENT_TIMESTAMP() WHERE id = :num",
                [
                    "num" => $subject_id
                ]
            );
        }
    }


    public function insertSubject($title){
        $this->executeQuery(
            "INSERT INTO subject (title, user_id) VALUES (:title, :user)",
            [
                "title"  => $title,
                "user" => Session::get("user")->getId()
            ]
        );
        return $this->getLastInsertId();
    }

    public function switchlock($id, bool $bool){
        $state = $bool ? 1 : 0;
        $this->executeQuery(
            "UPDATE subject SET isLocked = :bool WHERE id = :num",
            [
                "bool" => $state,
                "num" => $id
            ]
        );
    }
}