<?php
require_once 'requeteBase.php';
require_once "Classes/InputText.php";
require_once "Classes/InputPassword.php";
require_once "Classes/InputCheckbox.php";

use Form\Type\InputText;
use Form\Type\InputPassword;
use Form\Type\InputCheckbox;


class VerifInscription{
    protected BaseDeDonnee $database;
    protected string $tentative;

    public function __construct(){
        $this->database = new BaseDeDonnee();
        $this->tentative = $_POST['tentative'] ?? '';

        if ($this->tentative == true && $this->database->pseudoExistant($_POST['pseudo']) == false){
            $this->inscriptionBD($_POST['pseudo'], $_POST['mdp'], $_POST['nomComplet'], ($_POST['estArtiste']) ? true : false);
        }
    }

    private function inscriptionBD(string $pseudo, string $mdp, string $nomComplet, bool $estArtiste){
        $mdpChiffre = hash('sha256', $mdp);
        $this->database->insertionCompte($pseudo, $mdpChiffre, $nomComplet, $estArtiste);
        
        $contenuPOST = array(
            'tentative' => 'true',
            'identifiant' => $pseudo,
            'mdp' => $mdpChiffre
        );

        echo "<form id='redirectionConnexion' action='connexion.php' method='POST'>
                <input type='hidden' name='tentative' value='true' />
                <input type='hidden' name='identifiant' value=$pseudo />
                <input type='hidden' name='mdp' value=$mdp />
            </form>";
    }

    public function __toString(){
        $identifiant = new InputText("connect","pseudo","Pseudo unique","pseudoCompte",true, "Identifiant :");
        $nomComplet = new InputText("connect","nomComplet","Nom original","nomComplet",true, "Nom complet :");
        $mdp = new InputPassword("connect","mdp","Mot de passe confidentiel","mdpCompte",true, "Mot de passe :");
        $estArtiste = new InputCheckbox("connect","estArtiste","value","estArtiste",false, "Je souhaite un créer un compte artiste.");

        $output ="<main>
                    <h1><img src='fixtures/images/line.png'> Inscription <img src='fixtures/images/line.png'></h1>";

        
        if ($this->tentative){
            $output .= "<p>Identifiants incorrects !</p><p>Assurez vous d'utiliser un pseudonyme unique.</p>";
        }
        $output .= "<form method='POST' >
                    <input type='hidden' name='tentative' value='true' />
                        <section>";
        $output .= $identifiant->render();
        $output .="</section>
                    <section>";
        $output .= $nomComplet->render();
        $output .="</section>
                    <section>";
        $output .= $mdp->render();
        $output .="</section>
                    <section class = 'estArtiste'>";
        $output .= $estArtiste->render();
        $output .="</section>";

        $output .= "<button type='submit' name='creation'>Créer mon compte</button>
                    </form>";
        $output .= "<a href='connexion.php'>Vous avez déjà un compte ? Connectez vous ici !</a>
                    </main>";

        return $output;
    }
}
