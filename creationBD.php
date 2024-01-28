<?php
    require_once 'vendor/autoload.php'; // Inclure l'autoloader de Composer

    use Symfony\Component\Yaml\Yaml;
    
    // Lecture du fichier YAML
    $dataArtiste = Yaml::parseFile('fixtures/artiste.yml');
    $dataAlbum = Yaml::parseFile('fixtures/albums.yml');

    try{
        $file_db = new PDO("sqlite:musinear.sqlite3");
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        $file_db->exec("DROP TABLE IF EXISTS PLAYLIST");
        $file_db->exec("DROP TABLE IF EXISTS NOTER");
        $file_db->exec("DROP TABLE IF EXISTS UTILISATEUR");
        $file_db->exec("DROP TABLE IF EXISTS TITRE");
        $file_db->exec("DROP TABLE IF EXISTS ALBUM");
        $file_db->exec("DROP TABLE IF EXISTS GENRE");
        $file_db->exec("DROP TABLE IF EXISTS ARTISTE");
        $file_db->exec("DROP TABLE IF EXISTS COMPTE");


        ######################################################################
        ############## TABLE COMPTE ##########################################
        ######################################################################

        # Création 

        $file_db->exec("CREATE TABLE COMPTE(
            idCompte INTEGER PRIMARY KEY,
            pseudo VARCHAR(20),
            mdp VARCHAR(20))");

        #Insertion

        $insert="INSERT INTO COMPTE (idCompte, pseudo, mdp) VALUES (:idCompte, :pseudo, :mdp)";
        $stmt=$file_db->prepare($insert);
        $stmt->bindParam(':idCompte', $idCompte);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':mdp', $mdp);

        $idCompte=1;
        $pseudo="Stary Kids";
        $mdp="123240";
        $stmt->execute();

        ######################################################################
        ############## TABLE ARTISTE #########################################
        ######################################################################

        # Création 
        
        $file_db->exec("CREATE TABLE ARTISTE(
            idArtiste INTEGER PRIMARY KEY REFERENCES COMPTE (idCompte),
            nomArtiste VARCHAR(50),
            biographie TEXT,
            cheminPhoto TEXT)");

        #Insertion

        $insert="INSERT INTO ARTISTE (idArtiste, nomArtiste, biographie, cheminPhoto) VALUES (:idArtiste, :nomArtiste, :biographie, :cheminPhoto)";
        $stmt=$file_db->prepare($insert);
        $stmt->bindParam(':idArtiste', $idArtiste);
        $stmt->bindParam(':nomArtiste', $nomArtiste);
        $stmt->bindParam(':biographie', $biographie);
        $stmt->bindParam(':cheminPhoto', $cheminPhoto);
        
        foreach($dataArtiste as $artiste){
            $idArtiste = $artiste["entryId"];
            $nomArtiste = $artiste["nom"];
            $biographie = $artiste["biographie"];
            $cheminPhoto = $artiste["cheminPhoto"];
            $stmt->execute();
        }

        ######################################################################
        ############## TABLE UTILISATEUR #####################################
        ######################################################################

        # Création 
        
        $file_db->exec("CREATE TABLE UTILISATEUR(
            idUtilisateur INTEGER PRIMARY KEY REFERENCES COMPTE (idCompte),
            nomUtilisateur VARCHAR(20))");

        #Insertion

        $insert="INSERT INTO UTILISATEUR (idUtilisateur, nomUtilisateur) VALUES (:idUtilisateur, :nomUtilisateur)";
        $stmt=$file_db->prepare($insert);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur);
        $stmt->bindParam(':nomUtilisateur', $nomUtilisateur);


        ######################################################################
        ############## TABLE GENRE ###########################################
        ######################################################################

        # Création 
        
        $file_db->exec("CREATE TABLE GENRE(
            idGenre INTEGER PRIMARY KEY,
            nomGenre VARCHAR(15))");

        #Insertion

        $insert="INSERT INTO GENRE (idGenre, nomGenre) VALUES (:idGenre, :nomGenre)";
        $stmt=$file_db->prepare($insert);
        $stmt->bindParam(':idGenre', $idGenre);
        $stmt->bindParam(':nomGenre', $nomGenre);


        ######################################################################
        ############## TABLE ALBUM ###########################################
        ######################################################################

        # Création 
        
        $file_db->exec("CREATE TABLE ALBUM(
            idArtiste INTEGER REFERENCES ARTISTE (idArtiste),
            idAlbum INTEGER,
            nomAlbum VARCHAR(50),
            annee INTEGER,
            cheminPochette TEXT,
            PRIMARY KEY(idArtiste, idAlbum))");

        #Insertion

        $insert="INSERT INTO ALBUM(idArtiste, idAlbum, nomAlbum, annee, cheminPochette) VALUES (:idArtiste, :idAlbum, :nomAlbum, :annee, :cheminPochette)";
        $stmt=$file_db->prepare($insert);
        $stmt->bindParam(':idArtiste', $idArtiste);
        $stmt->bindParam(':idAlbum', $idAlbum);
        $stmt->bindParam(':nomAlbum', $nomAlbum);
        $stmt->bindParam(':annee', $annee);
        $stmt->bindParam(':cheminPochette', $cheminPochette);

        foreach($dataAlbum as $album){
            $idArtiste = $album["by"];
            $idAlbum = $album["entryId"];
            $nomAlbum = $album["title"];
            $annee = $album["releaseYear"];
            $cheminPochette = $album["img"];
            $stmt->execute();
        }


        ######################################################################
        ############## TABLE TITRE ###########################################
        ######################################################################

        # Création 
        
        $file_db->exec("CREATE TABLE TITRE(
            idTitre INTEGER,
            idAlbum INTEGER,
            nomTitre VARCHAR(50),
            PRIMARY KEY (idTitre, idAlbum))");

        #Insertion

        $insert="INSERT INTO TITRE (idTitre, idAlbum, nomTitre) VALUES (:idTitre, :idAlbum, :nomTitre)";
        $stmt=$file_db->prepare($insert);
        $stmt->bindParam(':idTitre', $idTitre);
        $stmt->bindParam(':idAlbum', $idAlbum);
        $stmt->bindParam(':nomTitre', $nomTitre);


        ######################################################################
        ############## TABLE PLAYLIST ########################################
        ######################################################################

        # Création 
        
        $file_db->exec("CREATE TABLE PLAYLIST(
            idUtilisateur INTEGER REFERENCES UTILISATEUR (idUtilisateur),
            idTitre INTEGER REFERENCES TITRE (idTitre),
            nomPlaylist VARCHAR(20),
            PRIMARY KEY (idUtilisateur, idTitre))");

        #Insertion

        $insert="INSERT INTO PLAYLIST (idUtilisateur, idTitre, nomPlaylist) VALUES (:idUtilisateur, :idTitre, :nomPlaylist)";
        $stmt=$file_db->prepare($insert);
        $stmt->bindParam(':idUtilisateur',$idUtilisateur);
        $stmt->bindParam(':idTitre', $idTitre);
        $stmt->bindParam(':nomPlaylist', $nomPlaylist);


    }
    catch(PDOException $e){
        echo "PDOException: " . $e->getMessage();
    }
?>