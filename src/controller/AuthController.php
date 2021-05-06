<?php
namespace App\Controller;

use App\Core\AbstractController;
use App\Core\Session;
use App\Model\Manager\UserManager;

class AuthController extends AbstractController
{
    public function __construct(){
        $this->manager = new UserManager();
    }
    /**
     * display the login form or compute the login action with post data
     * 
     * @return mixed the render of the login view or a Router redirect (if login action succeeded)
     */
    public function login(){

        
        if(isset($_POST["submit"])){
            sleep(1);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/[a-zA-Z\d-]$/" // Alphanumériques et tiret uniquement
                ]
            ]);

            if($email && $password){
                if($user = $this->manager->getUserByEmail($email)){//on récupère l'user si l'email saisi correspond en BDD
                    if($user->getBanEnd(false) < new \DateTime()){
                        if(password_verify($password, $this->manager->getPasswordByEmail($email))){
                            Session::set("user", $user);
                            Session::addFlash('success', "Bienvenue !");
                            
                            return $this->redirectToRoute("home");
                        }
                        else Session::addFlash('error', "Le mot de passe est erroné");
                    }
                    else Session::addFlash("error", "Connexion impossible. Utilisateur banni jusqu'au ".$user->getBanEnd(true)." pour ".$user->getBanReason());
                }
                else Session::addFlash('error', "E-mail inconnu !");
            }
            else Session::addFlash('error', "Des champs ne respectent pas la syntaxe requise");

        }

        if(Session::get("user")){
            $this->redirectToRoute("home");
        }
        else{
            return $this->render("visitor/login.php", [
                "title" => "Connexion"
            ]);    
        }
        
    }

    public function logout(){
        Session::remove("user");
        Session::addFlash('success', "Déconnexion réussie !");
        return $this->redirectToRoute("home");
    }

    public function register(){
        if(isset($_POST["submit"])){
            sleep(1);
            $username = trim(filter_input(INPUT_POST, "username", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^(?=.*[a-zA-Z])[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]{3,}$/"
                    // Uniquement alphanumériques, au moins une lettre, tiret du 6 uniquement entre deux caractères et minimum 3 caractères
                ]
            ]));
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/"
                    //au moins 6 caractères, MAJ, min et chiffre obligatoires
                ]
            ]);
            $password_repeat = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);
            
            if($username && $email && $password){
                if(!$this->manager->getUserByEmail($email)){
                    if(!$this->manager->getUserByUsername($username)){
                        if($password === $password_repeat){

                            $hash = password_hash($password, PASSWORD_ARGON2I);

                            if($this->manager->insertUser($email, $username, $hash)){
                                Session::addFlash('success', "Inscription réussie, connectez-vous !");
                                
                                return $this->redirectToRoute("auth", "login");
                            }
                            else Session::addFlash('error', "Une erreur est survenue...");
                        }
                        else Session::addFlash('error', "Les mots de passe ne correspondent pas !");
                    }
                    else Session::addFlash('error', "Nom d'utilisateur déjà pris...");
                }
                else Session::addFlash('error', "Cette adresse mail est déjà liée à un compte...");
            }
            else Session::addFlash('error', "Les champs saisis ne respectent pas les valeurs attendues !");
        }

        return $this->render("visitor/register.php", [
            "title" => "Inscription"
        ]);
    }

}