<?php 
class Cuisine {
    public $filles=array();
    public $maxSimultane;



    public function  peutAccepter(){
        if(count($this->filles) < $this->maxSimultane){
            return true;
        } else {
            return false;
        }
    }

    public function ajouter(Commande $c){
        if($this->peutAccepter()){
            array_push($this->filles, $c);
            return true;
        } else {
            echo "Cuisine pleine, impossible d'ajouter la commande.";
            return false;
        }

    }

    public function terminerUneCommande(){
        if(count($this->filles) > 0){
            $commande = array_shift($this->filles);
            $commande->etat = "Prête";
            return $commande;
        } else {
            echo "Aucune commande en cours.";
            return null;
        }

    }

    public function commandesEnCours(){
        $enCours = array();
        foreach($this->filles as $commande){
            if($commande->etat == "En attente" || $commande->etat == "En cours"){
                array_push($enCours, $commande);
            }
        }
        return $enCours;
    }
}




?>