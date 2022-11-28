<?php
include 'db.php';

class User extends DB{
    private $nombre;
    private $username;


    public function userExists($user, $pass){
        $md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM user WHERE useNametag = :user AND usePassword = :pass');
        $query->execute(['user' => $user, 'pass' => $md5pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM user WHERE useNametag = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->useId = $currentUser['useId'];
            $this->useDNI = $currentUser['useDNI'];
            $this->useName = $currentUser['useName'];
            $this->useLastName = $currentUser['useLastName'];
            $this->useNametag = $currentUser['useNametag'];
            $this->useEmail = $currentUser['useEmail'];
            $this->usePassword = $currentUser['usePassword'];
            $this->useRol = $currentUser['useRol'];
        }
    }

    public function getID(){
        return $this->useId;
    }

    public function getDNI(){
        return $this->useDNI;
    }

    public function getName(){
        return $this->useName;
    }

    public function getLastName(){
        return $this->useLastName;
    }

    public function getNametag(){
        return $this->useNametag;
    }
    
    public function getEmail(){
        return $this->useEmail;
    }

    public function getRol(){
        return $this->useRol;
    }
    
}
?>