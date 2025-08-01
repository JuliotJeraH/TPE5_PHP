<?php 
class Serveur {
    public $id;
    public $nom;



    public function trouverTableLibre(Client $client, array $tables) {
        foreach ($tables as $table) {
            if (!$table->occupee && $table->peutAccueillir($client->nombrePersonnes)) {
                return $table;
            }
        }
        echo "Aucune table libre trouvée.\n";
        return null;
    }

    public function prendreCommande(Client $client, TableResto $table, int $id){
        $commande = new Commande();
        $commande->id = $id;
        $commande->client = $client;
        $commande->date = date("Y-m-d H:i:s");
        $commande->table = $table;
        $commande->etat = "En attente";

        echo "Commande prise pour le client: " . $client->nom . " à la table: " . $table->numero . "\n";
        return $commande;

    }

    public function ajouterPlatACommande(Commande $commande, MenuItem $plat, int $qte, Inventaire $inv) {
        if ($inv->peutProduire($plat, $qte)) {
            $commande->ajouterPlat($plat, $qte, $inv);
            echo "Plat ajouté à la commande: " . $plat->nom . " x" . $qte . "\n";
        } else {
            echo "Quantité insuffisante pour le plat: " . $plat->nom . "\n";
        }
    }

    public function envoyerCommandeCuisine(Commande $commande, Cuisine $cuisine, Inventaire $inv) {
        if ($commande->etat == "En attente") {
            if ($cuisine->peutAccepter()) {
                $cuisine->ajouter($commande);
                $commande->etat = "En cours";
                echo "Commande envoyée à la cuisine.\n";
            } else {
                echo "Cuisine pleine, impossible d'envoyer la commande.\n";
            }
        } else {
            echo "La commande n'est pas en attente.\n";
        }
    }
}



?>