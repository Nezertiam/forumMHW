<?php

namespace App\Model\Manager;

use App\Core\AbstractManager;
use App\Core\ManagerInterface;


class ReportManager extends AbstractManager implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Report",
            "SELECT * FROM signalements WHERE id = :num",
            [
                "num" => $id
            ]
        );
    }

    public function getAll(){
        return $this->getResults(
            "App\Model\Entity\Report",
            "SELECT * FROM signalements"
        );
    }

    public function insertReport($askingUserId, $reportedUserId, $reason, $messageId = NULL){
        return $this->executeQuery(
            "INSERT INTO report (askingUser, reportedUser, reportReason, message_id) VALUES (:a, :rep, :rea, :m)",
            [
                "a" => $askingUserId,
                "rep" => $reportedUserId,
                "rea" => $reason,
                "m" => $messageId
            ]
        );
    }

    public function deleteReport($id){
        return $this->executeQuery(
            "DELETE FROM report WHERE id = :num",
            [
                "num" => $id
            ]
        );
    }
}