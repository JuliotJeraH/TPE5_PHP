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

    public function totalHT() {
        $total = 0;
        foreach ($this->lignes as $ligne) {
            $total += $ligne->sousTotal();
        }
        if($total> 150){
            $total *= 0.9;
        }
        return $total;
    }

    public function totalTTC() {
        $total = $this->totalHT();
        return $total * 1.2;
    }

    public function envoyerCuisine(Cuisine $cuisine, Inventaire $inv) {
        if ($this->etat == "En attente") {
            if ($cuisine->peutAccepter()) {
                $cuisine->ajouter($this);
                $this->etat = "En cours";
                echo "Commande envoyée à la cuisine.\n";
            } else {
                echo "Cuisine pleine, impossible d'envoyer la commande.\n";
            }
        } else {
            echo "La commande n'est pas en attente.\n";
        }

    }

    public function marquerPrete() {
        if (count($this->lignes) > 0) {
            $this->etat = "Prête";
            return true;
        } else {
            echo "Aucune ligne de commande à marquer comme prête.";
            return false;
        }
    }

    public function payer() {
        if ($this->etat == "Prête") {
            $this->etat = "Payée";
            $this->table = null;
            return true;
        } else {
            echo "La commande n'est pas prête à être payée.";
            return false;
        }
    }

    public function decrire() {
        $description = "Commande ID: " . $this->id . "\n";
        $description .= "Client: " . $this->client->nom . "\n";
        $description .= "Date: " . $this->date . "\n";
        if ($this->table) {
            $description .= "Table: " . $this->table->numero . "\n";
        } else {
            $description .= "Table: Aucune\n";
        }
        $description .= "État: " . $this->etat . "\n";
        $description .= "Lignes de commande:\n";

        foreach ($this->lignes as $ligne) {
            $description .= "- " . $ligne->plat->nom . " x" . $ligne->quantite . " (Sous-total: " . $ligne->sousTotal() . ")\n";
        }

        return $description;
        
    }
}




?>