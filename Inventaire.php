<?php 
class Inventaire{
    public $stocks= array();


    public function ajouterIngredient(Ingredient $i){
        array_push($this->stocks, $i);
    }

    public function peutProduire(MenuItem $p, int $q){
        foreach($this->stocks as $stock){
            if($stock->nom == $p->ingredient->nom){
                if($stock->quantite >= $q * $p->ingredient->quantite){
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    public function consommer(MenuItem $p, int $q){
        foreach($this->stocks as $stock){
            if($stock->nom == $p->ingredient->nom){
                if($stock->quantite >= $q * $p->ingredient->quantite){
                    $stock->quantite -= $q * $p->ingredient->quantite;
                    return true;
                } else {
                    echo "Quantité insuffisante pour l'ingrédient: " . $stock->nom;
                    return false;
                }
            }
        }
        echo "Ingrédient non trouvé: " . $p->ingredient->nom;
        return false;
    }

    public function alertesStock(){
        $alerte = array();
        foreach($this->stocks as $stock){
            if($stock->quantite < $stock->seuilReappro){
                $alerte[] = $stock->nom . " est en dessous du seuil de réapprovisionnement.";
            }
        }
        if(empty($alerte)){
            return "Aucune alerte de stock.";
        } else {
            return $alerte;
        }
    }

    public function AffichePlatIndisponible($LignesCommande){
        $indisponibles = array();
        foreach (alertesStock() as $alerte) {
            foreach ($LignesCommande as $ligne) {
                if ($ligne->ingredient->nom == $alerte) {
                    $indisponibles[] = $ligne->nom;
                }
        }
    }   echo "Plats indisponibles en raison d'un stock insuffisant : ";
    if (empty($indisponibles)) {
        echo "Tous les plats sont disponibles.";
    } else {
        foreach ($indisponibles as $plat) {
            echo $plat->nom . "<br>";
        }
    }
}
    
}





?>