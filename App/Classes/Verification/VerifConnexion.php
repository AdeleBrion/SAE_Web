<?php
namespace Classes\Verification;
require_once "autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();
use Classes\BD\BaseDeDonnee;
use Classes\Input\InputText;
use Classes\Input\InputPassword;

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

    private function donneesValides(string $pseudo, string $password){
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
                    <h1><img src='fixtures/images/line.png'> Connexion <img src='fixtures/images/line.png'></h1>";
        if ($this->tentative){
            $output .= "<p>Identifiants incorrects !</p>";
        }
        $output .= "<form action='connexion.php' method='POST' >
                    <input type='hidden' name='tentative' value='true' />
                    <section class = 'sectionIdentifiant'>";         
        $output .= $identifiant->render();
        $output .="</section>
                    <section class = 'sectionMDP'>";         
        $output .= $mdp->render();
        $output .="</section>";
       
        $output .= "<button type='submit' name='connexion'>Se connecter</button>
                    </form>";
        $output .= "<a href='inscription.php'>Pas encore de compte ? Inscrivez-vous ici !</a>
                </main>";

        return $output;
    }

}

?>