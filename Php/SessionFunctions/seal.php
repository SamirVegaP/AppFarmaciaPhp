<?php
include 'database.php';

class Seal extends DB2{
    private $nombre;
    private $username;

    public function setSeal($seal){
        $query = $this->connect()->prepare('SELECT * FROM seal WHERE seaId = :user');
        $query->execute(['user' => $seal]);
        
        foreach ($query as $currentUser) {
            $this->seaId = $currentUser['seaId'];
            $this->seaDate = $currentUser['seaDate'];
            $this->seaVoucher = $currentUser['seaVoucher'];
            $this->seaFee = $currentUser['seaFee'];
            $this->cliId = $currentUser['cliId'];
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