<!DOCTYPE html>
<html lang=fr>

<head>
    <link rel="icon" type="image/png" href="Logo-Sesame.png" />
    <title>profil</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-language" content="fr" />
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
            <a class="p-2 text-dark" href="profilchef.php">profil</a>
            <a class="p-2 text-dark" href="demanderchef.php">Demander</a>
            <a class="p-2 text-dark" href="mesdemandeschef.php">Mes demandes</a>
            <a class="p-2 text-dark" href="validationchef.php">Validation</a>
        </nav>
        <a class="btn btn-outline-success" href="Deconnexion.php">déconnexion</a>
    </div>

    <center>

        <?php
      session_start();
			$serveur="localhost";
			$login="root";
			$pass="";
            $id=$_SESSION['mat'];
			try{
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $connexion->query('SET NAMES utf8');
				$requete1=$connexion->prepare("
					SELECT MATRICULE,NOM,PRENOM,ROLE,NOM_POSTE ,ID_POSTE FROM UTILISATEUR natural join POSTE where MATRICULE=$id");
				$requete1->execute();
				$requete1=$requete1->fetchall();
				$MAT=$requete1[0][0];
				$NOM=$requete1[0][1];
				$PRENOM=$requete1[0][2];
				$ROLE=$requete1[0][3];
        $POSTE=$requete1[0][4];
        $ID_POSTE=$requete1[0][5];
        $_SESSION['idPOSTE']=$requete1[0][5];//pour validation chef//
        $requete2=$connexion->prepare("SELECT NOM_DEPARTEMENT FROM DEPARTEMENT natural join POSTE where ID_POSTE=$ID_POSTE");
        $requete2->execute();
        $requete2=$requete2->fetchall();
        $DIVISION=$requete2[0][0];
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
                                <td>Poste</td>
                                <td><?php echo $POSTE ?></td>
                            </tr>
                            <tr>
                                <td>Departement</td>
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