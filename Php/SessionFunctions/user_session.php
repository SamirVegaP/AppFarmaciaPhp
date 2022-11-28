<?php

class UserSession{
    
    public function __construct(){
        session_start();
    }

    public function setCurrentUser($user){
        $_SESSION['user'] = $user;
    }

    public function getCurrentUser(){
        return $_SESSION['user'];
    }

    public function setCurrentSeal($seal){
        $_SESSION['seal'] = $seal;
    }

    public function getCurrentSeal(){
        return $_SESSION['seal'];
    }

    public function setCurrentBuyout($buyout){
        $_SESSION['buyout'] = $buyout;
    }

    public function getCurrentBuyout(){
        return $_SESSION['buyout'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}


?>