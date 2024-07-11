<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include '../Data_base/db_connection.php';
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO UTILISATEUR (MATRICULE,ID_POSTE, NOM, PRENOM, MAIL, SOLDE_CONGE, ROLE,NUMERO_TELEPHONE, MANAGER_MATRICULE ,MOT_DE_PASSE)
        VALUES (:matricule, :id_poste,:nom, :prenom, :mail, :solde_conge, :role, :numero_telephone,:supervisor,:password)";

    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':matricule', $_POST['Matricule']);
    $stmt->bindParam(':id_poste', $_POST['poste']);
    $stmt->bindParam(':numero_telephone', $_POST['NumeroTelephone']);
    $stmt->bindParam(':nom', $_POST['nom']);
    $stmt->bindParam(':prenom', $_POST['prenom']);
    $stmt->bindParam(':mail', $_POST['mail']);
    $stmt->bindParam(':solde_conge', $_POST['SOLDE_CONGE']);
    $stmt->bindParam(':role', $_POST['role']);
    $stmt->bindParam(':password', $hashedPassword);

    if ($_POST['role'] === 'Responsable_RH') {
        $supervisor = null;
    } else {
        $supervisor = $_POST['supervisor'];
    }

    $stmt->bindParam(':supervisor', $supervisor);

    // Execute the query
    try {
        $stmt->execute();
        echo "Utilisateur ajouté avec succès!";
        header("Location:../addUser.php?go=1");
    } catch(PDOException $e) {
        echo "Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage();
    }

    // Close the database connection
    $connexion = null;
}
?>