<?php

namespace App\Model\Manager;

use App\Core\AbstractManager;
use App\Core\ManagerInterface;


class MessageManager extends AbstractManager implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getAll(){
        return;
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Message",
            "SELECT * FROM message WHERE id = :num",
            [
                "num" => $id
            ]
        );
    }

}