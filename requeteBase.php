<?php

    class baseDeDonnée {

        protected $pdo;

        public function __construct() {
            try {
                $this->pdo = new PDO('sqlite:musinear.sqlite3');
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Erreur de connexion à la base de données : " . $e->getMessage();
            }
        }

        public function getAlbum(){
            try{
                $query = "SELECT nomAlbum, cheminPochette
                FROM ALBUM NATURAL JOIN ARTISTE
                WHERE idArtiste = 1";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $album = new albumNomImage($row["nomAlbum"], "fixtures/images/" . $row["cheminPochette"]);
                    echo "<a class="."album".">" . $album . "</a>";
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>