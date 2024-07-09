<?php
// Database connection parameters
$serveur = 'localhost';
$login = "root";
$pass = "";
$database = 'gestionconge';

try {
    // Establish a connection to the database
    $connexion = new PDO("mysql:host=$serveur;dbname=$database", $login, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch all managers where ROLE = 'Manager'
    $sql = "SELECT MATRICULE, NOM, PRENOM FROM UTILISATEUR WHERE ROLE = 'Manager'";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    // Fetch all rows as associative array
    $managers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($managers);
} catch(PDOException $e) {
    // Handle database connection error
    echo "Connection failed: " . $e->getMessage();
    exit();
}
$connexion = null; // Close the connection
?>