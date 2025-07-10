<?php 
class LigneCommande{
    public $plat;
    public $quantite;
    

    public function sousTotal(Inventaire $inventaire){
        if($this->plat->estDisponible($inventaire)){
            return $this->plat->prixHT * $this->quantite;
        } else {
            return 0;
        }
    }
}




?>