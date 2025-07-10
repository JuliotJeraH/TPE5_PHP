<?php 
class MenuItem{
    public $id;
    public $nom;
    public $prixHT;
    public $categorie;
    public $disponible;
    public $recette;
    

 public function estDisponible() {
        $estDisponible = false;
        foreach ($this->recette as $ingredient => $quantite) {
            if(!$ingredient->estPerime(new DateTime()) && $ingredient->stockKg >= $quantite) {
                $estDisponible = true;
            } else {
                $estDisponible = false;
                break;
            }
        }
        return $estDisponible;
    }

}

?>