<?php
include 'database.php';

class Seal extends DB2{
    private $nombre;
    private $username;

    public function setBuyout($seal){
        $query = $this->connect()->prepare('SELECT * FROM buyout WHERE buyId = :user');
        $query->execute(['user' => $seal]);
        
        foreach ($query as $currentUser) {
            $this->seaId = $currentUser['buyId'];
            $this->seaDate = $currentUser['buyDate'];
            $this->seaVoucher = $currentUser['buyPayment'];
            $this->buyVoucher = $currentUser['buyVoucher'];
            $this->cliId = $currentUser['supId'];
            $this->empId = $currentUser['empId'];
        }
    }

    public function getID(){
        return $this->seaId;
    }

    public function getDate(){
        return $this->seaDate;
    }

    public function getVoucher(){
        return $this->seaVoucher;
    }

    public function getClient(){
        return $this->cliId;
    }
    
    public function getEmp(){
        return $this->empId;
    }
    
}
?>