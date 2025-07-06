<?php 

class Commande {
    public $id;
    public $client;
    public $date;
    public $table;
    public $etat;
    public $lignes = array();


    public function ajoutLigne(LigneCommande $ligne) {
        array_push($this->lignes, $ligne);
    }

    public function ajouterPlat(MenuItem $plat, int $qte, Inventaire $inv) {
        $ligne = new LigneCommande($plat, $qte);
        if ($inv->disponible($plat, $qte)) {
            $this->ajoutLigne($ligne);
            $inv->retirer($plat, $qte);
        } else {
            echo "Quantité insuffisante pour le plat: " . $plat->nom;
        }

    }

    public totalHT() {
        $total = 0;
        foreach ($this->lignes as $ligne) {
            $total += $ligne->sousTotal();
        }
        if($total> 150){
            $total *= 0.9;
        }
        return $total;
    }

    public totalTTC() {
        $total = $this->totalHT();
        return $total * 1.2;
    }

    public function envoyerCuisine(Cuisine $cuisine, Inventaire $inv) {


    }

    public marquerPrete() {
        if (count($this->lignes) > 0) {
            $this->etat = "Prête";
            return true;
        } else {
            echo "Aucune ligne de commande à marquer comme prête.";
            return false;
        }
    }

    public payer() {
        if ($this->etat == "Prête") {
            $this->etat = "Payée";
            $this->table = null;
            return true;
        } else {
            echo "La commande n'est pas prête à être payée.";
            return false;
        }
    }

    public decrire() {
        
    }
}




?>