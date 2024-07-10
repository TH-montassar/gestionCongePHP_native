<?php
// getPosts.php

// Assuming you receive department ID from POST request
if(isset($_POST['departementId'])) {
    $departementId = $_POST['departementId'];
    // Database connection parameters
    $serveur = 'localhost';
    $login = "root";
    $pass = "";
    $database = 'gestionconge';
    try {
        $connexion = new PDO("mysql:host=$serveur;dbname=$database", $login, $pass);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
        exit(); // Exit script if connection fails
    }
    // Query to get posts based on department
    $sql = "SELECT ID_POSTE, NOM_POSTE FROM POSTE WHERE ID_DEPARTEMENT = $departementId";
    $result = $connexion->prepare($sql);
    $result->execute();
    // Build options HTML
    $options = '<option selected>Choisir..</option>';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $options .= "<option value='" . $row['ID_POSTE'] . "'>" . $row['NOM_POSTE'] . "</option>";
    }
    // Close connection
    $connexion = null; // Close the connection
    // Return options HTML
    echo $options;
}
?>