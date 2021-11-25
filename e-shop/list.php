<?php
// Je récupère mon fichier config.php
// ce fichier contient ma connexion à la base de données
require 'inc/config.php';

// Je prépare ma requete SQL. 
$query = $bdd->prepare('SELECT * FROM item');
$query->execute(); // J'execute ma requete SQL

$mes_articles = $query->fetchAll(PDO::FETCH_ASSOC); // Les articles trouvés sont désormais accessibles dans la variable $mes_articles
// fetchAll()  // Je récupère plusieurs lignes de données

if(isset($_GET['delete'])){

    $id =$_GET['delete'];
    $bdd->query("DELETE FROM item WHERE id=$id");
	header('Location: list-item.php');
}


?>