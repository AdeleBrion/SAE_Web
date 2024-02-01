<?php

    class baseDeDonnee {

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
                $query = "SELECT *
                FROM ALBUM NATURAL JOIN ARTISTE";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $album = new albumNomImage($row["nomAlbum"], "fixtures/images/" . $row["cheminPochette"]);
                    $id = $row["idAlbum"];
                    echo "<a href="."albumDetail.php?id=$id"." class="."album".">" . $album . "</a>";
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getAlbumImage($album){
            try{
                $query = "SELECT * FROM ALBUM WHERE idAlbum = $album";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<img class='couverture' src='fixtures/images/".$row['cheminPochette']."'>";
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getAlbumByArtist($artiste){
            try{
                $query = "SELECT nomAlbum, cheminPochette
                FROM ALBUM NATURAL JOIN ARTISTE
                WHERE idArtiste = $artiste";
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

        public function getArtiste(){
            try{
                $query = "SELECT nomArtiste, cheminPhoto
                FROM ARTISTE";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $album = new albumNomImage($row["nomArtiste"], "fixtures/images/" . $row["cheminPhoto"]);
                    echo "<a class="."album".">" . $album . "</a>";
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getArtisteById(int $id){
            try{
                $query = "SELECT nomArtiste, cheminPhoto
                FROM ARTISTE";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $album = new albumNomImage($row["nomArtiste"], "fixtures/images/" . $row["cheminPhoto"]);
                    echo "<a class="."album".">" . $album . "</a>";
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getTitreByAlbum($album){
            try{
                $query = "SELECT * FROM TITRE NATURAL JOIN ALBUM WHERE idAlbum = $album";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $track = new track($row['idTitre'], $row['nomTitre']);
                    echo $track;
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>