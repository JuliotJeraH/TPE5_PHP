<?php 
class TableResto{
    public $numero;
    public $capacite;
    public $occupee;


    public function peutAccueillir(int $n){
        if($n <= $this->capacite){
            return true;
        } else {
            return false;
        }
    }

    public function placerClients(){
        if(!$this->occupee){
            $this->occupee = true;
            return "Table ".$this->numero." est maintenant occupée.";
        } else {
            return "Table ".$this->numero." est déjà occupée.";
        }
    }

    public function liberer(){
        if($this->occupee){
            $this->occupee = false;
            return "Table ".$this->numero." est maintenant libre.";
        } else {
            return "Table ".$this->numero." est déjà libre.";
        }
        
    }
}




?>