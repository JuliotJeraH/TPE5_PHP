<?php 
require_once("Ingredient.php");
require_once("Inventaire.php");
require_once("Client.php");
require_once("Commande.php");
require_once("Cuisine.php");
require_once("LigneCommande.php");
require_once("MenuItem.php");
require_once("Restaurant.php");
require_once("Serveur.php");
require_once("TableResto.php");



// -------------------- Ingredients ----------------------

$Ingredient1 = new Ingredient();
$Ingredient1->nom = "Pâte à pizza";
$Ingredient1->stockKg = 100.00;
$Ingredient1->seuilReappro = 10.00;
$Ingredient1->peremption = "20-07-2025";
$Ingredient1->prixKg = 8.00;


$Ingredient2 = new Ingredient();
$Ingredient2->nom = "Tomates";
$Ingredient2->stockKg = 50.00;
$Ingredient2->seuilReappro = 25.00;
$Ingredient2->peremption = "15-11-2025";
$Ingredient2->prixKg = 7.00;

$Ingredient3 = new Ingredient();
$Ingredient3->nom = "Fromage mozzarella";
$Ingredient3->stockKg = 40.00;
$Ingredient3->seuilReappro = 20.00;
$Ingredient3->peremption = "10-09-2025";
$Ingredient3->prixKg = 15.00;


$Ingredient4 = new Ingredient();
$Ingredient4->nom = "Basilic";
$Ingredient4->stockKg = 30.00;
$Ingredient4->seuilReappro = 2.00;
$Ingredient4->peremption = "15-07-2025";
$Ingredient4->prixKg = 20.00;

$Ingredient5 = new Ingredient();
$Ingredient5->nom = "Laitue";
$Ingredient5->stockKg = 100.00;
$Ingredient5->seuilReappro = 5.00;
$Ingredient5->peremption = "01-12-2025";
$Ingredient5->prixKg = 2.60;

$Ingredient6 = new Ingredient();
$Ingredient6->nom = "Poulet grillé";
$Ingredient6->stockKg = 15.00;
$Ingredient6->seuilReappro = 3.00;
$Ingredient6->peremption = "10-07-2025";
$Ingredient6->prixKg = 5.00;

$Ingredient7 = new Ingredient();
$Ingredient7->nom = "Croûtons";
$Ingredient7->stockKg = 10.00;
$Ingredient7->seuilReappro = 2.00;
$Ingredient7->peremption = "05-10-2025";
$Ingredient7->prixKg = 45.00;

$Ingredient8 = new Ingredient();
$Ingredient8->nom = "Parmesan";
$Ingredient8->stockKg = 5.00;
$Ingredient8->seuilReappro = 1.00;
$Ingredient8->peremption = "30-09-2025";
$Ingredient8->prixKg = 80.00;

$Ingredient9 = new Ingredient();
$Ingredient9->nom = "Sauce César";
$Ingredient9->stockKg = 8.00;
$Ingredient9->seuilReappro = 2.00;
$Ingredient9->peremption = "25-11-2025";
$Ingredient9->prixKg = 15.00;


// -------------------------- MenuItem ----------------------
$MenuItem1 = new MenuItem();
$MenuItem1->id = 1;
$MenuItem1->nom = "Pizza Margherita";
$MenuItem1->prixHT = 6.00;
$MenuItem1->categorie = "plat";

$MenuItem1->recette = [
    "Pâte à pizza" => 0.2,
    "Tomates" => 0.1,
    "Fromage mozzarella" => 0.15,
    "Basilic" => 0.05
];

$MenuItem2 = new MenuItem();
$MenuItem2->id = 2;
$MenuItem2->nom = "Salade César";
$MenuItem2->prixHT = 4.60;
$MenuItem2->categorie = "plat";

$MenuItem2->recette = [
    "Laitue" => 0.2,
    "Poulet" => 0.15,
    "Croutons" => 0.1,
    "Parmesan" => 0.05,
    "Sauce César" => 0.05
];


//------------------------ Table Resto----------------------
$Table1 = new TableResto();
$Table1->numero = 5;
$Table1->capacite = 4;
$Table1->occuppee = false;

$Table2 = new TableResto();
$Table2->numero = 3;
$Table2->capacite = 2;
$Table2->occuppee = false;

// List des tables
$tables = [$Table1, $Table2];

// --------------------- client -----------------------------
$Client1 = new Client();
$Client1->nom = "Rasolo";
$Client1->nombrePersonnes = 4;

$Client2 = new Client();
$Client2->nom = "Tolotra";
$Client2->nombrePersonnes = 2;

// --------------------- Trouver table pour le client ----------------------
$tableLibre = $Serveur1->trouverTableLibre($Client1, $tables);
$tableLibre->placerClients();

// -------------------- Commandes ----------------------
$Commande1= $Serveur1->prendreCommande($Client1, $tableLibre, 1);

// ---------------------- lignes de commande ----------------------
$LigneCommande1 = new LigneCommande();
$LigneCommande1->plat = $MenuItem1;
$LigneCommande1->quantite = 2;

$LigneCommande2 = new LigneCommande();
$LigneCommande2->plat = $MenuItem2;
$LigneCommande2->quantite = 2;

// ---------------------- Ajouter des lignes de commande à la commande ----------------------
$Commande1->ajouterLigne($LigneCommande1);
$Commande1->ajouterLigne($LigneCommande2);


// ---------------------- Inventaire ----------------------
$Inventaire1 = new Inventaire();
$Inventaire1->ajouterIngredient($Ingredient1);
$Inventaire1->ajouterIngredient($Ingredient2);
$Inventaire1->ajouterIngredient($Ingredient3);
$Inventaire1->ajouterIngredient($Ingredient4);
$Inventaire1->ajouterIngredient($Ingredient5);
$Inventaire1->ajouterIngredient($Ingredient6);
$Inventaire1->ajouterIngredient($Ingredient7);
$Inventaire1->ajouterIngredient($Ingredient8);
$Inventaire1->ajouterIngredient($Ingredient9);

// ---------------------- Ajouter des plats à la commande ----------------------
$Serveur1->ajouterPlatACommande($Commande1, $MenuItem1, 2, $Inventaire1);
$Serveur1->ajouterPlatACommande($Commande1, $MenuItem2, 2, $Inventaire1);

// ---------------------- envoi de la commande à la cuisine ----------------------
$Cuisine = new Cuisine();
$Cuisine->maxSimultane = 5;

$Serveur1->envoyerCommandeCuisine($Commande1, $Cuisine, $Inventaire1);


// ----------------------- termine la commande en cuisine ----------------------

$commandePrete = $Cuisine->terminerUneCommande();
if ($commandePrete) {
    echo "Commande " . $commandePrete->id . " est prête.\n";
}

// ----------------------- Paiement et libération de la table ----------------------
$totalHT = $Commande1->totalHT();
$totalTTC = $Commande1->totalTTC();
echo "Total HT: " . $totalHT . " | Total TTC: " . $totalTTC . "\n";

// ----------------------------- Libération de la table ------------------------
echo $tableLibre->liberer();

// ------------------------ Afficher les ingrédients à recharger ----------------------
$alertes = $Inventaire1->alertesStock();
if (!empty($alertes)) {
    echo "Ingrédients à recharger :\n";
    foreach ($alertes as $alerte) {
        echo "- " . $alerte->nom . " (Stock: " . $alerte->stockKg . " kg, Seuil: " . $alerte->seuilReappro . " kg)\n";
    }
} else {
    echo "Aucun ingrédient à recharger.\n";
}

// ----------------------- Restaurant ----------------------
$Restaurant = new Restaurant();
$Restaurant->nom = "Mahavoky";
$Restaurant->tables = $tables;
$Restaurant->menu = array($MenuItem1, $MenuItem2);
$Restaurant->inventaire = $Inventaire1;
$Restaurant->cuisine = $Cuisine;





?>