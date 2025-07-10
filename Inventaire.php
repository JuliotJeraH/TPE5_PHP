<?php 
class Inventaire{
    public $stocks= array();


    public function ajouterIngredient(Ingredient $i){
        array_push($this->stocks, $i);
    }

    public function peutProduire(MenuItem $p, int $q) {
        foreach ($this->stocks as $stock) {
            foreach ($p->recette as $ingredient => $quantite) {
                if ($stock->nom == $ingredient) {
                    if ($stock->stockKg < $q * $quantite) { // Use stockKg instead of quantite
                        echo "Quantité insuffisante pour l'ingrédient: " . $stock->nom;
                        return false;
                    }
                } else {
                    echo "Ingrédient non trouvé: " . $ingredient;
                    return false;
                }
            }
        }
        return true; // Adjusted to return true if all checks pass
    }

    public function consommer(MenuItem $p, int $q) {
        foreach ($this->stocks as $stock) {
            foreach ($p->recette as $ingredientName => $ingredientQuantity) {
                if ($stock->nom == $ingredientName) {
                    if ($stock->stockKg >= $q * $ingredientQuantity) {
                        $stock->stockKg -= $q * $ingredientQuantity;
                        return true;
                    } else {
                        echo "Quantité insuffisante pour l'ingrédient: " . $stock->nom;
                        return false;
                    }
                }
            }
        }
        echo "Ingrédient non trouvé: " . $ingredientName;
        return false;
    }

    public function alertesStock() {
        $alerte = array();
        foreach ($this->stocks as $stock) {
            if ($stock->stockKg < $stock->seuilReappro) {
                $alerte[] = $stock; // Store the Ingredient object instead of a string
            }
        }
        return $alerte;
    }

    public function AffichePlatIndisponible($LignesCommande) {
        $indisponibles = array();
        $alertes = $this->alertesStock(); // Call alertesStock() correctly
        foreach ($LignesCommande as $ligne) {
            foreach ($alertes as $alerte) {
                if (in_array($alerte->nom, array_keys($ligne->plat->recette))) {
                    $indisponibles[] = $ligne->plat->nom;
                }
            }
        }
        echo "Plats indisponibles en raison d'un stock insuffisant : ";
        if (empty($indisponibles)) {
            echo "Tous les plats sont disponibles.";
        } else {
            foreach ($indisponibles as $plat) {
                echo $plat . "<br>";
            }
        }
    }
    public function getIngredientByName($name) {
        foreach ($this->stocks as $ingredient) {
            if ($ingredient->nom === $name) {
                return $ingredient;
            }
        }
        return null; // Return null if the ingredient is not found
    }
}





?>