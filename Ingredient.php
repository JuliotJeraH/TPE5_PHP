<?php 
 class Ingredient{
    public $nom;
    public $stockKg;
    public $seuilReappro;
    public $peremption;
    public $prixKg;


    public function retirer(float $kg){
        if($kg <= $this->stockKg){
            $this->stockKg -= $kg;
        } else {
            echo "Stock insuffisant pour retirer ".$kg."de".$this->nom;
        }
    }

    public function alerteStock(){
        $alerte = false;
        if($this->stockKg < $this->seuilReappro){
            $alerte = true;
            return $alerte;
        } else {
            return $alerte;

        }
    }

    public function estPerime(DateTime $date){
        $datePeremption = DateTime::createFromFormat('d-m-Y', $this->peremption);
        if($date > $datePeremption){
            return true;
        } else {
            return false;
        }
    }
}






?>