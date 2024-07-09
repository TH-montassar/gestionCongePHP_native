<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data validation and sanitation should be implemented here
    
    // Example: Establish database connection
    $serveur = 'localhost';
    $login = "root";
    $pass = "";
    $database = 'gestionconge';

    try {
        $connexion = new PDO("mysql:host=$serveur;dbname=$database", $login, $pass);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"; // Uncomment for testing
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit(); // Exit script if connection fails
    }

    // Example: Prepare SQL statement to insert user data
    $sql = "INSERT INTO UTILISATEUR (MATRICULE, NUMERO_TELEPHONE, NOM, PRENOM, MAIL, SOLDE_CONGE, ROLE, MANAGER_MATRICULE, ID_DEPARTEMENT, POSTE) 
            VALUES (:matricule, :numero_telephone, :nom, :prenom, :mail, :solde_conge, :role, :supervisor, :departement, :poste)";
    
    // Example: Bind parameters and execute SQL query
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':matricule', $_POST['Matricule']);
    $stmt->bindParam(':numero_telephone', $_POST['NumeroTelephone']);
    $stmt->bindParam(':nom', $_POST['nom']);
    $stmt->bindParam(':prenom', $_POST['prenom']);
    $stmt->bindParam(':mail', $_POST['mail']);
    $stmt->bindParam(':solde_conge', $_POST['SOLDE_CONGE']);
    $stmt->bindParam(':role', $_POST['role']);

    // Determine the supervisor based on the selected role
    if ($_POST['role'] === 'Responsable_RH') {
        // For 'Responsable_RH', supervisor should be NULL or an empty string
        $supervisor = null; // or set it to an empty string as per your database schema
    } else {
        // For other roles, supervisor should be the selected supervisor's matricule
        $supervisor = $_POST['supervisor'];
    }

    $stmt->bindParam(':supervisor', $supervisor);
    $stmt->bindParam(':departement', $_POST['departement']);
    $stmt->bindParam(':poste', $_POST['poste']);

    // Execute the query
    try {
        $stmt->execute();
        echo "Utilisateur ajouté avec succès!";
    } catch(PDOException $e) {
        echo "Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage();
    }

    // Close the database connection
    $connexion = null;
}
?>