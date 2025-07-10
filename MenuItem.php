<?php 
class MenuItem{
    public $id;
    public $nom;
    public $prixHT;
    public $categorie;
    public $disponible;
    public $recette;
    

 public function estDisponible(Inventaire $inventaire) {
    $estDisponible = true;
    foreach ($this->recette as $ingredientName => $quantite) {
        $ingredient = $inventaire->getIngredientByName($ingredientName); // Retrieve the Ingredient object
        if (!$ingredient || $ingredient->estPerime(new DateTime()) || $ingredient->stockKg < $quantite) {
            $estDisponible = false;
            break;
        }
    }
    return $estDisponible;
}

}

?>