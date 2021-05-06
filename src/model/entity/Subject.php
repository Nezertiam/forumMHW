<?php

namespace App\Model\Entity;
use App\Core\AbstractEntity;
use App\Core\EntityInterface;

class Subject extends AbstractEntity implements EntityInterface
{

    private $id;
    private $title;
    private $createdAt;
    private $isLocked;
    private $user;
    private $nbMessages;
    private $lastMessageDate;


    public function __construct($data){
        parent::hydrate($data, $this);
        
    }

    public function __toString(){
        return "<a href='?ctrl=subject&action=voirSubject&id=".$this->id."'>".($this->getIsLocked() ? "[Résolu]".$this->getTitle() : $this->getTitle())."</a>";
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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt)
    {
        if($createdAt !== null){
            $this->createdAt = new \DateTime($createdAt);
        }
        else $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of isLocked
     */ 
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Set the value of isLocked
     *
     * @return  self
     */ 
    public function setIsLocked($isLocked)
    {
        $isLocked == 1 ? $this->isLocked = true : $this->isLocked = false;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of nbMessages
     */ 
    public function getNbMessages()
    {
        return $this->nbMessages;
    }

    /**
     * Set the value of nbMessages
     *
     * @return  self
     */ 
    public function setNbMessages($nbMessages)
    {
        $this->nbMessages = $nbMessages;

        return $this;
    }

    /**
     * Get the value of lastMessageDate
     */ 
    public function getLastMessageDate($format = true)
    {
        return $format ? strftime("%d %B %G", strtotime($this->lastMessageDate->format("d F Y")))." à ".$this->lastMessageDate->format("H:i") : $this->lastMessageDate;
    }

    /**
     * Set the value of lastMessageDate
     *
     * @return  self
     */ 
    public function setLastMessageDate($lastMessageDate)
    {
        $this->lastMessageDate = new \DateTime($lastMessageDate);

        return $this;
    }
}