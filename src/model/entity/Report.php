<?php

namespace App\Model\Entity;
use App\Core\AbstractEntity;
use App\Core\EntityInterface;
use App\Model\Manager\UserManager;

class Report extends AbstractEntity implements EntityInterface
{
    private $id;
    private $message;
    private $reportedUser;
    private $askingUser;
    private $reportReason;
    private $reportDate;


    public function __construct($data){
        parent::hydrate($data, $this);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of reportedUser
     */ 
    public function getReportedUser()
    {
        return $this->reportedUser;
    }

    /**
     * Set the value of reportedUser
     *
     * @return  self
     */ 
    public function setReportedUser($reportedUserId)
    {
        $umanager = new UserManager();
        $this->reportedUser = $umanager->getOneById($reportedUserId);

        return $this;
    }

    /**
     * Get the value of aaskingUser
     */ 
    public function getAskingUser()
    {
        return $this->askingUser;
    }

    /**
     * Set the value of aaskingUser
     *
     * @return  self
     */ 
    public function setAskingUser($askingUserId)
    {
        $umanager = new UserManager();
        $this->askingUser = $umanager->getOneById($askingUserId);

        return $this;
    }

    /**
     * Get the value of reportReason
     */ 
    public function getReportReason()
    {
        return $this->reportReason;
    }

    /**
     * Set the value of reportReason
     *
     * @return  self
     */ 
    public function setReportReason($reportReason)
    {
        $this->reportReason = $reportReason;

        return $this;
    }

    /**
     * Get the value of reportDate
     */ 
    public function getReportDate($format = false)
    {
        return $format ? $this->reportDate->format("d/m/Y à H:i") : $this->reportDate ;
    }

    /**
     * Set the value of reportDate
     *
     * @return  self
     */ 
    public function setReportDate($reportDate)
    {
        $this->reportDate = new \DateTime($reportDate);

        return $this;
    }
}