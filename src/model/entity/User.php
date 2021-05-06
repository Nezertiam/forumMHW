<?php

namespace App\Model\Entity;
use App\Core\AbstractEntity;
use App\Core\EntityInterface;
use App\Core\Session;

class User extends AbstractEntity implements EntityInterface
{

    private $id;
    private $name;
    private $email;
    private $role;
    private $createdAt;
    private $banEnd;
    private $banReason;
    private $nbPosts;

    public function __construct($data){
        parent::hydrate($data, $this);
    }

    public function __toString(){
        return "<a href='?ctrl=home&action=user&id=".$this->id."'>".$this->name."</a>";
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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime($createdAt);

        return $this;
    }

    /**
     * Get the value of banEnd
     */ 
    public function getBanEnd($format = false)
    {
        return $format ? $this->banEnd->format("d/m/Y") : $this->banEnd ;
    }

    /**
     * Set the value of banEnd
     *
     * @return  self
     */ 
    public function setBanEnd($banEnd)
    {
        $this->banEnd = new \DateTime($banEnd);

        return $this;
    }

    /**
     * Get the value of banReason
     */ 
    public function getBanReason()
    {
        return $this->banReason;
    }

    /**
     * Set the value of banReason
     *
     * @return  self
     */ 
    public function setBanReason($banReason)
    {
        $this->banReason = $banReason;

        return $this;
    }

    /**
     * Get the value of nbPosts
     */ 
    public function getNbPosts()
    {
        return $this->nbPosts;
    }

    /**
     * Set the value of nbPosts
     *
     * @return  self
     */ 
    public function setNbPosts($nbPosts)
    {
        $this->nbPosts = $nbPosts;

        return $this;
    }

    public function getLevel(){
        $n = $this->nbPosts;
        if($n < 30){
            if($n < 20){
                if($n < 10){
                    if($n < 2){
                        $lvl = str_repeat("<p class='fas fa-square-full gris'></p>", 4)." Nouveau chasseur";
                    }
                    else $lvl = str_repeat("<p class='fas fa-square-full bleu'></p>", 1).str_repeat("<p class='fas fa-square-full gris'></p>", 3)." Chasseur Novice";
                }
                else $lvl = str_repeat("<p class='fas fa-square-full vert'></p>", 2).str_repeat("<p class='fas fa-square-full gris'></p>", 2)." Chasseur Expert";
            }
            else $lvl = str_repeat("<p class='fas fa-square-full rouge'></p>", 3).str_repeat("<p class='fas fa-square-full gris'></p>", 1)." Chasseur Maître";
        }
        else $lvl = str_repeat("<p class='fas fa-square-full gold'></p>", 4)." Conquérant du Fief Glorieux";

        return $lvl;
    }

    public function hasRole($role){
        return $this->getRole() === $role;
    }

}