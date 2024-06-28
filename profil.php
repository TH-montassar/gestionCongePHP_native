<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="Logo-Sesame.png" />
    <title>profil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Pour que le rendu et le zoom-->
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><img src="Logo-Sesame.png" height="40" width="40"
                class="rounded float-left"><img src="Logo-Sesame.png" height="200" width="200"
                class="rounded float-left"></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="profil.php">profil</a>
            <a class="p-2 text-dark" href="demander.php">Demander</a>
            <a class="p-2 text-dark" href="mesdemandes.php">Mes demandes</a>
        </nav>
        <a class="btn btn-outline-success" href="Deconnexion.php">déconnexion</a>
    </div>

    <center>

        <?php
			$serveur="localhost";
			$login="root";
			$pass="";
            $id=$_SESSION['mat'];
			try{
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $connexion->query('SET NAMES utf8');
                // Fetch UTILISATEUR and POSTE information
				$requete1=$connexion->prepare("
                    SELECT a.MATRICULE, a.NOM, a.PRENOM, a.ROLE, s.NOM_POSTE, s.ID_POSTE
                    FROM UTILISATEUR a
                    JOIN POSTE s ON a.ID_POSTE = s.ID_POSTE
                    WHERE a.MATRICULE = $id
                    ");
				$requete1->execute();
				$UTILISATEUR=$requete1->fetchall();
                if ($UTILISATEUR) {
                    $MAT=$UTILISATEUR[0][0];
                    $NOM=$UTILISATEUR[0][1];
                    $PRENOM=$UTILISATEUR[0][2];
                    $ROLE=$UTILISATEUR[0][3];
                    $POSTE=$UTILISATEUR[0][4];
                    $ID_POSTE=$UTILISATEUR[0][5];
                    // Fetch division information

                    $requete2 = $connexion->prepare("
                        SELECT d.NOM_DIVITION
                        FROM DEPARTEMENT d
                        JOIN POSTE s ON d.ID_DIVITION = s.ID_DIVITION
                        WHERE s.ID_POSTE = $ID_POSTE
                    ");
                    $requete2->execute();
                    $division = $requete2->fetch(PDO::FETCH_ASSOC);

                    if ($division) {
                        $DIVISION = $division['NOM_DIVITION'];
                    } else {
                        $DIVISION = "N/A";
                    }
                    // Fetch division information m2
                    /* $requete2=$connexion->prepare("SELECT NOM_DIVITION FROM DEPARTEMENT natural join POSTE where ID_POSTE=$ID_POSTE");
                    $requete2->execute();
                    $requete2=$requete2->fetchall();
                    $DIVISION=$requete2[0][0] */;

                } else {
                    echo "No UTILISATEUR found with the given MATRICULE.";
                }
			}
			catch(PDOEXEPTION $e){
				echo 'Echec:'.$e->get_Message();
			}
			?>
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <table class="table table-bordered table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2">
                                    <center>Informations personnel</center>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Matricule</td>
                                <td><?php echo $MAT ?></td>
                            </tr>
                            <tr>
                                <td>nom</td>
                                <td><?php echo $NOM ?></td>
                            </tr>
                            <tr>
                                <td>Prénom</td>
                                <td><?php echo $PRENOM ?></td>
                            </tr>
                            <tr>
                                <td>ROLE</td>
                                <td><?php echo $ROLE ?></td>
                            </tr>
                            <tr>
                                <td>Servive</td>
                                <td><?php echo $POSTE ?></td>
                            </tr>
                            <tr>
                                <td>Division</td>
                                <td><?php echo $DIVISION ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </center>
</body>

</html>