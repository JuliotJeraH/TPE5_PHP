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
    $Ingredient1 => 0.2,
    $Ingredient2 => 0.1,
    $Ingredient3 => 0.15,
    $Ingredient4 => 0.05
];

$MenuItem2 = new MenuItem();
$MenuItem2->id = 2;
$MenuItem2->nom = "Salade César";
$MenuItem2->prixHT = 4.60;
$MenuItem2->categorie = "plat";

$MenuItem2->recette = [
    $Ingredient5 => 0.2,
    $Ingredient6 => 0.15,
    $Ingredient7 => 0.1,
    $Ingredient8 => 0.05,
    $Ingredient9 => 0.05
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

if($Table1->peutAccueillir($Client1->nombrePersonnes)){
    echo $Table1->placerClients();
} else {
    echo "La table ".$Table1->numero." ne peut pas accueillir ".$Client1->nombrePersonnes." personnes.";
}

if($Table2->peutAccueillir($Client2->nombrePersonnes)){
    echo $Table2->placerClients();
} else {
    echo "La table ".$Table2->numero." ne peut pas accueillir ".$Client2->nombrePersonnes." personnes.";
}


// -------------------- Commandes ----------------------
$Commande1 = new Commande();
$Commande1->id = 1;
$Commande1->client = $Client1->nom;
$Commande1->date = "2023-10-01";
$Commande1->table = $Table1;
$Commande1->etat = "En attente";

$Commande2 = new Commande();
$Commande2->id = 2;
$Commande2->client = $Client2->nom;
$Commande2->date = "2023-10-02";
$Commande2->table = $Table2;
$Commande2->etat = "En attente";

// Ajout des lignes de commande à la commande
$Commande1->ajoutLigne($Ligne1);
$Commande2->ajoutLigne($Ligne2);

// Calcul du total HT pour chaque commande
echo $totalCommande1 = $Commande1->totalHT();
echo $totalCommande2 = $Commande2->totalHT();


$Client1 = new Client();
$Client1->nom = "Rasolo";
$Client1->nombrePersonnes = 4;

$Client2 = new Client();
$Client2->nom = "Tolotra";
$Client2->nombrePersonnes = 2;

// ----------------------- Initialisation ----------------------

// 1. Initialiser le stock avec 5 ingrédients
$Inventaire1 = new Inventaire();
$Inventaire1->ajouterIngredient($Ingredient1);
$Inventaire1->ajouterIngredient($Ingredient2);
$Inventaire1->ajouterIngredient($Ingredient3);
$Inventaire1->ajouterIngredient($Ingredient4);
$Inventaire1->ajouterIngredient($Ingredient5);

// 2. Proposer 2 plats à la carte
$MenuItem1 = new MenuItem();
$MenuItem1->id = 1;
$MenuItem1->nom = "Pizza Margherita";
$MenuItem1->prixHT = 6.00;
$MenuItem1->categorie = "plat";
$MenuItem1->recette = [
    $Ingredient1 => 0.2,
    $Ingredient2 => 0.1,
    $Ingredient3 => 0.15,
    $Ingredient4 => 0.05
];

$MenuItem2 = new MenuItem();
$MenuItem2->id = 2;
$MenuItem2->nom = "Salade César";
$MenuItem2->prixHT = 4.60;
$MenuItem2->categorie = "plat";
$MenuItem2->recette = [
    $Ingredient5 => 0.2,
    $Ingredient6 => 0.15,
    $Ingredient7 => 0.1,
    $Ingredient8 => 0.05,
    $Ingredient9 => 0.05
];

// ----------------------- Client et Serveur ----------------------

// 3. Un client (4 personnes) arrive. Le serveur l’installe à une table.
$Client1 = new Client();
$Client1->nom = "Rasolo";
$Client1->nombrePersonnes = 4;

$Table1 = new TableResto();
$Table1->numero = 5;
$Table1->capacite = 4;
$Table1->occupee = false;

$Serveur1 = new Serveur();
$Serveur1->id = 1;
$Serveur1->nom = "Antsa";

$tableLibre = $Serveur1->trouverTableLibre($Client1, [$Table1]);
if (!$tableLibre) {
    echo "Aucune table disponible pour le client.\n";
    exit;
}

// 4. Le client commande 2 portions de chaque plat.
$platsCommandes = [
    $MenuItem1 => 2,
    $MenuItem2 => 2
];

$Commande1 = $Serveur1->prendreCommande($Client1, $tableLibre, 1, $platsCommandes, $Inventaire1, $Cuisine);

// ----------------------- Cuisine ----------------------

// 5. La commande est envoyée à la cuisine.
$Serveur1->envoyerCommandeCuisine($Commande1, $Cuisine);

// 6. La cuisine traite la commande (la met en “prête”).
$commandePrete = $Cuisine->terminerUneCommande();
if ($commandePrete) {
    echo "Commande " . $commandePrete->id . " est prête.\n";
}

// ----------------------- Paiement et Libération ----------------------

// 7. Le client règle l’addition.
$totalHT = $Commande1->totalHT();
$totalTTC = $Commande1->totalTTC();
echo "Total HT: " . $totalHT . " | Total TTC: " . $totalTTC . "\n";

// 8. La table est libérée.
echo $tableLibre->liberer();

// ----------------------- Alertes Stock ----------------------

// 9. Afficher les ingrédients à recharger.
echo $Inventaire1->alertesStock();



// ----------------------- Restaurant ----------------------
$Restaurant = new Restaurant(); 
$Restaurant->nom = "La Bonne Table";
$Restaurant->tables= array($Table1, $Table2);
$Restaurant->menu = array($MenuItem1, $MenuItem2);
$Restaurant->inventaire = $Inventaire1;
$Restaurant->cuisine = $Cuisine;


// ----------------------- Inventaire ----------------------------

$Inventaire1 = new Inventaire();

$Inventaire1->ajouterIngredient($Ingredient1);
$Inventaire1->ajouterIngredient($Ingredient2);
$Inventaire1->ajouterIngredient($Ingredient3);
$Inventaire1->ajouterIngredient($Ingredient4);
$Inventaire1->ajouterIngredient($Ingredient5);


// -------------------- Clients ----------------------
$Client1 = new Client();
$Client1->nom = "Rasolo";
$Client1->nombrePersonnes = 4;

$Client2 = new Client();
$Client2->nom = "Tolotra";
$Client2->nombrePersonnes = 2;

//------------------------ Serveur ----------------------
$Serveur1 = new Serveur();
$Serveur1->id = 1;
$Serveur1->nom = "Antsa";

$Serveur2 = new Serveur();
$Serveur2->id = 2;
$Serveur2->nom = "Miora";



?>