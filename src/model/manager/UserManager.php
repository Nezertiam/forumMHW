<?php

namespace App\Model\Manager;

use App\Core\AbstractManager;
use App\Core\ManagerInterface;

class UserManager extends AbstractManager implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }
    
    public function getAll(){
        return;
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\User",
            "SELECT * FROM utilisateurs WHERE id = :num",
            [
                "num" => $id
            ]
        );
    }

    public function getUserByEmail($email){
        return $this->getOneOrNullResult(
            "App\Model\Entity\User",
            "SELECT * FROM utilisateurs WHERE email = :mail",
            [
                "mail" => $email
            ]
        );
    }

    public function getPasswordByEmail($email){
        return $this->getOneValue(
            "SELECT password FROM utilisateurs WHERE email = :mail",
            [
                "mail" => $email
            ]
        );
    }

    public function getUserByUsername($username){
        return $this->getOneOrNullResult(
            "App\Model\Entity\User",
            "SELECT * FROM utilisateurs WHERE name = :name",
            [
                "name" => $username
            ]
        );
    }

    public function insertUser($email, $username, $password){
        return $this->executeQuery(
            "INSERT INTO user (name, email, password) VALUES (:username, :email, :password)",
            [
                "username"  => $username,
                "email"     => $email,
                "password"  => $password
            ]
        );
    }

    public function banUntil($date, $banReason, $userId){
        return $this->executeQuery(
            "UPDATE user SET banEnd = :date, banReason = :reason WHERE id = :num",
            [
                "date" => $date,
                "reason" => $banReason,
                "num" => $userId
            ]
        );
    }
}