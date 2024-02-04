<?php

    class baseDeDonnee {

        protected string $cheminImages = "fixtures/images/";
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
                    $album = new albumNomImage($row["nomAlbum"], $this->cheminImages . $row["cheminPochette"]);
                    $id = $row["idAlbum"];
                    echo "<a href="."albumDetail.php?id=$id"." class="."album".">" . $album . "</a>";
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getAlbumById(int $id){
            try{
                $query = "SELECT nomAlbum, idArtiste, nomArtiste, annee, cheminPochette
                from ALBUM natural join ARTISTE
                WHERE idAlbum = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $artiste = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $artiste = array("idArtiste"=>$row["idArtiste"], "nomArtiste"=>$row["nomArtiste"],
                    "nomAlbum"=>$row["nomAlbum"], "annee"=>$row["annee"], "cheminPochette"=>$this->cheminImages.$row["cheminPochette"]);
                }

                return $artiste;
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
                    return "<img class='couverture' src='".$this->cheminImages.$row['cheminPochette']."'>";
                }
            }
            catch (PDOException $e) {
                return $e->getMessage();
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
                    $album = new albumNomImage($row["nomAlbum"], $this->cheminImages . $row["cheminPochette"]);
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
                    $album = new albumNomImage($row["nomArtiste"], $this->cheminImages . $row["cheminPhoto"]);
                    echo "<a class="."album".">" . $album . "</a>";
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getArtisteById(int $id){
            try{
                $query = "SELECT nomArtiste, biographie, cheminPhoto
                FROM ARTISTE
                WHERE idArtiste = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $artiste = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $artiste = array("nom"=>$row["nomArtiste"], "biographie"=>$row["biographie"], "cheminPhoto"=>$row["cheminPhoto"]);
                }

                return $artiste;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getArtisteImage(int $idArtiste){
            try{
                //à faire !
                $query = "SELECT nomArtiste, cheminPhoto
                FROM ARTISTE";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $album = new albumNomImage($row["nomArtiste"], $this->cheminImages . $row["cheminPhoto"]);
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
                $titres = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($titres, new track($row['idTitre'], $row['nomTitre']));
                }

                return $titres;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>