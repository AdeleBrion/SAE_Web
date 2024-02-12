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

    public function getIdMax(string $nomTable): int
    {
        try{
            switch (strtoupper($nomTable)) {
                case "COMPTE":
                    $nomColonne = "idCompte";
                    $nomTable = "COMPTE";
                    break;
                case "ARTISTE":
                    $nomColonne = "idArtiste";
                    $nomTable = "ARTISTE";
                    break;
                case "UTILISATEUR":
                    $nomColonne = "idUtilisateur";
                    $nomTable = "UTILISATEUR";
                    break;
                case "ALBUM":
                        $nomColonne = "idAlbum";
                        $nomTable = "ALBUM";
                        break;
                case "TITRE":
                        $nomColonne = "idTitre";
                        $nomTable = "TITRE";
                        break;
                case "GENRE":
                        $nomColonne = "idGenre";
                        $nomTable = "GENRE";
                        break;
            }

            $query = "SELECT max($nomColonne)
            FROM $nomTable";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return intval($row["max($nomColonne)"]);
            }

            return 0;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
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

    public function pseudoExistant(string $pseudo): bool
    {
        try{
            $query = "SELECT *
            FROM COMPTE
            WHERE pseudo = '$pseudo'";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return true;
            }

            return false;
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

    public function getNomCompte(int $idCompte): string
    {
        try{
            $query = "SELECT nomArtiste
            FROM ARTISTE
            WHERE idArtiste = $idCompte";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $row["nomArtiste"];
            }
            $query = "SELECT nomUtilisateur
            FROM UTILISATEUR
            WHERE idUtilisateur = $idCompte";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $row["nomUtilisateur"];
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertionCompte($pseudo, $mdp, $nomComplet, $estArtiste){
        try{
            $idCompte = $this->getIdMax('compte') + 1;
            $query = "INSERT INTO COMPTE VALUES (" . $idCompte . ", '" .$pseudo. "', '". $mdp."')";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            
            if ($estArtiste){
                $query = "INSERT INTO ARTISTE VALUES (" . $idCompte . ", '".$nomComplet."', 'biographie insignifiante', '".$this->cheminImages."defaultPP.png' )";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
            }
            else{
                $query = "INSERT INTO UTILISATEUR VALUES (" . $idCompte . ", '".$nomComplet."' )";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function supprimerTitre(int $id){
        try{
            $query = "DELETE FROM PLAYLIST WHERE idTtire = $id";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
            $query = "DELETE FROM TITRE WHERE idTtire = $id";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function supprimerAlbum(int $id){
        try{
            $query = "SELECT idTitre
            FROM TITRE
            WHERE idAlbum = $id";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->supprimerTitre(intval($row["idTitre"]));
            }

            $query = "DELETE FROM FAVORIS WHERE idAlbum = $id";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();

            $query = "DELETE FROM NOTER WHERE idAlbum = $id";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();

            $query = "DELETE FROM GENRER WHERE idAlbum = $id";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();

            $query = "DELETE FROM ALBUM WHERE idAlbum = $id";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function fermerCompte(int $id){
        try{
            if ($this->isArtiste($id)){             //si l'artiste est un artiste
                $query = "SELECT idAlbum
                FROM ALBUM
                WHERE idArtiste = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $titres = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->supprimerAlbum(intval($row['idAlbum']));
                }

                $query = "DELETE FROM STYLE_MUSICAL WHERE idArtiste = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();

                $query = "DELETE FROM ARTISTE WHERE idArtiste = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                
            } else {
                $query = "DELETE FROM SUIVRE WHERE idUtilisateur = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $query = "DELETE FROM FAVORIS WHERE idUtilisateur = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $query = "DELETE FROM NOTER WHERE idUtilisateur = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $query = "DELETE FROM PLAYLIST WHERE idUtilisateur = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
                $query = "DELETE FROM UTILISATEUR WHERE idUtilisateur = $id";
                $stmt=$this->pdo->prepare($query);
                $stmt->execute();
            }

            $stmt->execute();
            $query = "DELETE FROM COMPTE WHERE idCompte = $id";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isArtiste(int $idCompte): bool
    {
        try{
            $query = "SELECT *
            FROM ARTISTE
            WHERE idArtiste = $idCompte";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return true;
            }
            return false;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getEveryAlbums(): array
    {
        try{
            $query = "SELECT *
            FROM ALBUM NATURAL JOIN ARTISTE";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
            $albums = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $album = new AlbumNomImage((int) $row["idAlbum"], $row["nomAlbum"], $this->cheminImages . $row["cheminPochette"]);
                $id = $row["idAlbum"];
                array_push($albums, "<a href='albumDetail.php?id=".$id."' class="."album".">" . $album . "</a>");
            }

            return $albums;
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

    public function getAlbumsByArtist(int $idArtiste): array
    {
        try{
            $query = "SELECT idAlbum, nomAlbum, cheminPochette
            FROM ALBUM NATURAL JOIN ARTISTE
            WHERE idArtiste = $idArtiste";
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

    public function getGenresAlbum(int $idAlbum): array
    {
        try{
            $query = "SELECT nomGenre
            FROM ALBUM NATURAL JOIN GENRER NATURAL JOIN GENRE
            WHERE idAlbum = $idAlbum;";
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

    public function getStylesArtiste($idArtiste): array
    {
        try{
            $query = "SELECT nomGenre
            FROM ARTISTE NATURAL JOIN STYLE_MUSICAL NATURAL JOIN GENRE
            WHERE idArtiste= $idArtiste;";
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

    public function getTitresByAlbum(int $idAlbum): array
    {
        try{
            $query = "SELECT * FROM TITRE NATURAL JOIN ALBUM WHERE idAlbum = $idAlbum";
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

    public function albumEnFavoris(int $idUser, int $idAlbum): bool
    {
        try{
            $query = "SELECT * 
            FROM FAVORIS 
            WHERE idUtilisateur = $idUser AND idAlbum = $idAlbum";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return true;
            }

            return false;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function mettreAlbumFavoris(int $idUser, int $idAlbum){
        try{
            $query = "INSERT INTO FAVORIS VALUES ($idUser, $idAlbum)";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function retirerAlbumFavoris(int $idUser, int $idAlbum){
        try{
            $query = "DELETE FROM FAVORIS WHERE idUtilisateur = $idUser AND idAlbum = $idAlbum";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertionAlbum(int $idArtiste, string $nomAlbum, int $annee, string $lienPochette, array $titres, array $genres)
    {
        try{
            //insertion de l'album
            $idAlbum = $this->getIdMax('album') + 1;
            $query = "INSERT INTO ALBUM VALUES (" . $idArtiste . ", " . $idAlbum . ", '" . $nomAlbum . "', " . $annee . ", '" . $lienPochette . "')";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();

            //insertion des genres de l'album
            foreach ($genres as $idGenre) {
                $query = "INSERT INTO GENRER VALUES ($idAlbum, $idGenre)";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
            }

            //insertion des titres de l'album
            foreach ($titres as $num => $titre) {
                $query = "INSERT INTO TITRE VALUES ($num+1, $idAlbum, '" . $titre . "')";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function artisteSuivi(int $idUser, int $idArtiste): bool
    {
        try{
            $query = "SELECT * 
            FROM SUIVRE 
            WHERE idUtilisateur = $idUser AND idArtiste = $idArtiste";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return true;
            }
            return false;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function suivreArtiste(int $idUser, int $idArtiste){
        try{
            $query = "INSERT INTO SUIVRE VALUES ($idUser, $idArtiste)";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function abandonnerArtiste(int $idUser, int $idArtiste){
        try{
            $query = "DELETE FROM SUIVRE WHERE idUtilisateur = $idUser AND idArtiste = $idArtiste";
            $stmt=$this->pdo->prepare($query);
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function getEveryGenres(): array
    {
        try {
            $query = "SELECT idGenre, nomGenre
            FROM GENRE";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $genres = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $genre = array('id'=> $row['idGenre'], 'nom'=> $row['nomGenre']);
                array_push($genres, $genre);
            }
            return $genres;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
?>