<?php
require_once 'requeteBase.php';
require_once "Classes/InputText.php";
require_once "Classes/InputPassword.php";

use Form\Type\InputText;
use Form\Type\InputPassword;


class VerifConnexion{
    protected BaseDeDonnee $database;
    protected string $tentative;

    public function __construct(){
        $this->database = new BaseDeDonnee();
        $this->tentative = $_POST['tentative'] ?? '';

        if ($this->tentative == true){
            $this->donneesValides($_POST['identifiant'], $_POST['mdp']);
        }
    }

    public function donneesValides(string $pseudo, string $password){
        $idCompte = $this->database->getIdCompte($pseudo);

        if ($idCompte != 0){
            $mdpBD = $this->database->getMdpCompte($idCompte);
            $mdpSaisi = hash('sha256', $password);

            if ($mdpBD == $mdpSaisi){
                $_SESSION['me'] = $idCompte;
                header('Location: index.php');
            }
        }
    }

    public function __toString(){
        $identifiant = new InputText("connect","identifiant","Insérez votre pseudo","pseudoCompte",true, "Pseudo :");
        $mdp = new InputPassword("connect","mdp","Saississez votre mot de passe","mdpCompte",true, "Mot de passe :");

        $output ="<main>
                    <h1><img src='fixtures/images/line.png'> Connexion <img src='fixtures/images/line.png'></h1>
                    <form action='connexion.php' method='post' >
                    <input type='hidden' name='tentative' value='true' />";
                    
        $output .="<section class = 'sectionIdentifiant'>";         
        $output .= $identifiant->render();
        $output .="</section>";

        $output .="<section class = 'sectionMDP'>";         
        $output .= $mdp->render();
        $output .="</section>";

        if ($this->tentative){
            $output .= "<p>Identifiants incorrects !</p>";
        }

        $output .="<section class = 'sectionButton'>";         
        $output .= "<button type='submit' name='connexion'>Se connecter</button>
                    </section>            
                    </form>
                </main>";

        return $output;
    }

}

?>
