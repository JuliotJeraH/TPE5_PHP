<?php 
class Restaurant{
    public $nom;
    public $tables= array();
    public $menu;
    public $inventaire;
    public $cuisine;

    public function ajouterTable(TableResto $t){
        if(!in_array($t, $this->tables)){
            array_push($this->tables, $t);
        } else {
            echo "La table existe déjà.\n";
        }
        
    }

    public function ajouterMenuItem(MenuItem $m){
        if(!in_array($m, $this->menu)){
            array_push($this->menu, $m);
        } else {
            echo "L'élément de menu existe déjà.\n";
        }

    }

    public function trouverTableLibre(int $n){
        foreach ($this->tables as $table) {
            if ($table->numero == $n && !$table->occupee) {
                return $table;
            }
        }
        echo "Aucune table libre trouvée pour le numéro: " . $n . "\n";
        return null;
        
    }
}





?>