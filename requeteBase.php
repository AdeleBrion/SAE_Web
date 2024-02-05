<?php

    class BaseDeDonnee {

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

        public function getIdCompte(string $pseudo): int
        {
            try{
                $query = "SELECT idCompte, pseudo
                FROM COMPTE
                WHERE pseudo = '$pseudo'";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return intval($row["idCompte"]);
                }

                return 0;
            }
            catch (PDOException $e) {
                echo $e->getMessage().gettype($pseudo);
            }   
        }

        public function getMdpCompte(int $idCompte): string
        {
            try{
                $query = "SELECT mdp
                FROM COMPTE
                WHERE idCompte = $idCompte";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $row["mdp"];
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }   
        }

        public function getAlbum(){
            try{
                $query = "SELECT *
                FROM ALBUM NATURAL JOIN ARTISTE";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $album = new AlbumNomImage((int) $row["idAlbum"], $row["nomAlbum"], $this->cheminImages . $row["cheminPochette"]);
                    $id = $row["idAlbum"];
                    echo "<a href='albumDetail.php?id=".$id."' class="."album".">" . $album . "</a>";
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getAlbumById(int $id): array
        {
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

        public function getAlbumImage(int $idalbum): string
        {
            try{
                $query = "SELECT * FROM ALBUM WHERE idAlbum = $idalbum";
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

        public function getAlbumsByArtist(int $id): array
        {
            try{
                $query = "SELECT idAlbum, nomAlbum, cheminPochette
                FROM ALBUM NATURAL JOIN ARTISTE
                WHERE idArtiste = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $albums = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($albums, new AlbumNomImage((int) $row["idAlbum"], $row["nomAlbum"], $this->cheminImages.$row["cheminPochette"]));
                }

                return $albums;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getGenresAlbum($id): array
        {
            try{
                $query = "SELECT nomGenre
                FROM ALBUM NATURAL JOIN GENRER NATURAL JOIN GENRE
                WHERE idAlbum = $id;";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $genres = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($genres, $row['nomGenre']);
                }

                return $genres;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getArtiste(){
            try{
                $query = "SELECT idArtiste, nomArtiste, cheminPhoto
                FROM ARTISTE";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $album = new AlbumNomImage((int) $row["idArtiste"], $row["nomArtiste"], $this->cheminImages . $row["cheminPhoto"]);
                    echo "<a href='artisteDetail.php?id=".$row["idArtiste"]."' class="."album".">" . $album . "</a>";
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getArtisteById(int $id): array
        {
            try{
                $query = "SELECT nomArtiste, biographie, cheminPhoto
                FROM ARTISTE
                WHERE idArtiste = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $artiste = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $artiste = array("nom"=>$row["nomArtiste"], "biographie"=>$row["biographie"], "cheminPhoto"=>$this->cheminImages.$row["cheminPhoto"]);
                }

                return $artiste;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getStylesArtiste($id): array
        {
            try{
                $query = "SELECT nomGenre
                FROM ARTISTE NATURAL JOIN STYLE_MUSICAL NATURAL JOIN GENRE
                WHERE idArtiste= $id;";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $styles = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($styles, $row['nomGenre']);
                }

                return $styles;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getTitresByAlbum($album): array
        {
            try{
                $query = "SELECT * FROM TITRE NATURAL JOIN ALBUM WHERE idAlbum = $album";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $titres = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($titres, new Track($row['idTitre'], $row['nomTitre']));
                }

                return $titres;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>