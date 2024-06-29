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
            <a class="p-2 text-dark" href="profiladmin.php">profil</a>
            <a class="p-2 text-dark" href="validationadmin.php">Validation</a>
            <a class="p-2 text-dark" href="consulter.php">consultation des demandes validées</a>
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
				$requete1=$connexion->prepare("SELECT MATRICULE,NOM,PRENOM,ROLE FROM UTILISATEUR where MATRICULE=$id");
				$requete1->execute();
				$UTILISATEUR=$requete1->fetchall();
				$MAT=$UTILISATEUR[0][0];
				$NOM=$UTILISATEUR[0][1];
				$PRENOM=$UTILISATEUR[0][2];
				$ROLE=$UTILISATEUR[0][3];
                // Fetch division and POSTE information
                $requete2 = $connexion->prepare("
                    SELECT
                        d.NOM_DIVITION,
                        s.NOM_POSTE
                    FROM
                        UTILISATEUR a
                    JOIN
                        POSTE s ON a.ID_POSTE = s.ID_POSTE
                    JOIN
                        DEPARTEMENT d ON s.ID_DIVITION = d.ID_DIVITION
                    WHERE
                        a.MATRICULE = $id
                ");
                $requete2->execute();
                $info = $requete2->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOEXEPTION $e){
				echo'echec:'.$e->get_message();
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
                                <td>Nom</td>
                                <td><?php echo $NOM ?></td>
                            </tr>
                            <tr>
                                <td>Prénom</td>
                                <td><?php echo $PRENOM ?></td>
                            </tr>
                            <tr>
                                <td>Rôle</td>
                                <td><?php echo $ROLE ?></td>
                            </tr>
                            <tr>
                                <td>POSTE</td>
                                <td><?php echo htmlspecialchars($info['NOM_POSTE']); ?></td>
                            </tr>
                            <tr>
                                <td>Departement</td>
                                <td><?php echo htmlspecialchars($info['NOM_DIVITION']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </center>
</body>

</html>