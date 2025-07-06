<?php 
class LigneCommande{
    public $plat;
    public $quantite;
    

    public function sousTotal(){
        if($this->plat->estDisponible()){
            return $this->plat->prixHT * $this->quantite;
        } else {
            return 0;
        }
    }
}






?>