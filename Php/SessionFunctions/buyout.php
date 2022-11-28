<?php
include 'database.php';

class Buyout extends DB2{
    private $nombre;
    private $username;

    public function setBuyout($seal){
        $query = $this->connect()->prepare('SELECT * FROM buyout WHERE buyId = :user');
        $query->execute(['user' => $seal]);
        
        foreach ($query as $currentUser) {
            $this->buyId = $currentUser['buyId'];
            $this->buyDate = $currentUser['buyDate'];
            $this->buyPayment = $currentUser['buyPayment'];
            $this->supId = $currentUser['supId'];
            $this->empId = $currentUser['empId'];
        }
    }

    public function getID(){
        return $this->buyId;
    }

    public function getDate(){
        return $this->buyDate;
    }

    public function getVoucher(){
        return $this->buyVoucher;
    }

    public function getClient(){
        return $this->supId;
    }
    
    public function getEmp(){
        return $this->empId;
    }
    
}
?>