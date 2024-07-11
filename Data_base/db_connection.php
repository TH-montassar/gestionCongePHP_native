<?php
$serveur = 'localhost';
$login = "root";
$pass = "";
$database = 'gestionconge';

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$database", $login, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Uncomment the line below for testing connection success
    // echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Exit script if connection fails
}
?>