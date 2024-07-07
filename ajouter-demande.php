<?php
session_start();

$serveur = "localhost";
$login = "root";
$pass = "";
$id = $_SESSION['mat'];

$DATE_D = $_POST['dd'];
$DATE_F = $_POST['df'];
$TYPE = $_POST['type'];
$SOLDE = ((strtotime($DATE_F) - strtotime($DATE_D)) / 86400);

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=gestionconge", $login, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $requete = $connexion->prepare("SELECT SOLDE_CONGE, ROLE FROM UTILISATEUR WHERE MATRICULE = :id");
    $requete->bindParam(':id', $id, PDO::PARAM_INT);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_ASSOC);

    $NBJ = $result['SOLDE_CONGE'];
    $role = $result['ROLE'];

    if ($NBJ == 0) {
        header("Location: " . ($role == 'Manager' ? "demanderchef.php?D=0" : "demander.php?D=0"));
    } elseif ($SOLDE <= 0) {
        header("Location: " . ($role == 'Manager' ? "demanderchef.php?D=3" : "demander.php?D=3"));
    } elseif ($SOLDE > 30) {
        header("Location: " . ($role == 'Manager' ? "demanderchef.php?D=1" : "demander.php?D=1"));
    } else {
        $N_SOLDE = $NBJ - $SOLDE;
        if ($N_SOLDE < 0) {
            header("Location: " . ($role == 'Manager' ? "demanderchef.php?DD=$NBJ" : "demander.php?DD=$NBJ"));
        } else {
            $requete1 = $connexion->prepare("
                INSERT INTO CONGE (MATRICULE, DATE_DEBUT, DATE_FIN, TYPE_CONGE, NOMBRE_JOUR,  ETAT)
                VALUES (:id, :date_d, :date_f, :type, :solde, 'Pending')
            ");
            $requete1->bindParam(':id', $id, PDO::PARAM_INT);
            $requete1->bindParam(':date_d', $DATE_D);
            $requete1->bindParam(':date_f', $DATE_F);
            $requete1->bindParam(':type', $TYPE);
            $requete1->bindParam(':solde', $SOLDE);
            $requete1->execute();

            $requete2 = $connexion->prepare("
                UPDATE UTILISATEUR
                SET SOLDE_CONGE = :n_solde
                WHERE MATRICULE = :id
            ");
            $requete2->bindParam(':n_solde', $N_SOLDE, PDO::PARAM_INT);
            $requete2->bindParam(':id', $id, PDO::PARAM_INT);
            $requete2->execute();

            header("Location: " . ($role == 'Manager' ? "demanderchef.php?D=2" : "demander.php?D=2"));
        }
    }
} catch (PDOException $e) {
    echo 'Échec : ' . $e->getMessage();
}
?>
