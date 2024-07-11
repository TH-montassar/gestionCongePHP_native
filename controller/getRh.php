<?php
include '../Data_base/db_connection.php';
try {
    // Query to fetch all employee where ROLE = 'Manager'
    $sql = "SELECT MATRICULE, NOM, PRENOM FROM UTILISATEUR WHERE ROLE = 'Responsable_RH'";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    // Fetch all rows as associative array
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($employees);
} catch(PDOException $e) {
    // Handle database connection error
    echo "Connection failed: " . $e->getMessage();
    exit();
}
 $connexion = null; // Close the connection
?>