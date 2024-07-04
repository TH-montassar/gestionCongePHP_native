<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="Logo-Sesame.png" />
    <title>Validation</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        $serveur = "localhost";
        $login = "root";
        $pass = "";

        try {
            $connexion = new PDO("mysql:host=$serveur;dbname=gestionconge", $login, $pass);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete1 = $connexion->prepare("SELECT NOM, PRENOM, DATE_DEBUT, DATE_FIN, TYPE_CONGE, NOMBRE_JOUR, ID_CONGE, ETAT, MATRICULE FROM CONGE NATURAL JOIN UTILISATEUR WHERE ROLE='Manager' AND ETAT != 'Approved' ORDER BY ID_CONGE DESC");
            $requete1->execute();
            $requete1 = $requete1->fetchAll();
            $MAT = $requete1[0][8];

            echo '<table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Matricule</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Date de début</th>
                        <th scope="col">Date de fin</th>
                        <th scope="col">Type de congé</th>
                        <th scope="col">NB_Jour</th>
                        <th scope="col">État</th>
                        <th scope="col">Validation</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($requete1 as $row) {
                echo '<tr>';
                // Output each column
                echo '<td>' . $row[8] . '</td>';
                echo '<td>' . $row[0] . '</td>';
                echo '<td>' . $row[1] . '</td>';
                echo '<td>' . $row[2] . '</td>';
                echo '<td>' . $row[3] . '</td>';
                echo '<td>' . $row[4] . '</td>';
                echo '<td>' . $row[5] . '</td>';
                echo '<td>' . $row[7] . '</td>'; // ETAT
                // Validation column with dropdown
                echo '<td>';
                if ($row[7] == 1 || $row[7] == -1) {
                    echo '</td>';
                } else {
                    echo '<div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="Accepter.php?ID=' . $row[6] . '& E=1">Accepter</a>
                                <a class="dropdown-item" href="refuser.php?ID=' . $row[6] . '& N=' . $row[5] . '& MAT=' . $MAT . '& E=1">Refuser</a>
                                <a class="dropdown-item" href="modifier.php?ID=' . $row[6] . '& E=1">Modifier</a>
                            </div>
                        </div>';
                    echo '</td>';
                }
                echo '</tr>';
            }
            echo "</tbody></table>";
        } catch (PDOException $e) {
            echo 'Échec : ' . $e->getMessage();
        }
        ?>
    </center>

    <!-- JavaScript -->
    <script src="bootstrap-4.3.1-dist/js/jquery-3.3.1.min.js"
        integrity="sha384-aDSMK77V/k74gA+6B4VnclwZJdXh2PI569RY2P2GWx+fo/N+PxMNq+qFY+QGhQxT" crossorigin="anonymous">
    </script>
    <script src="bootstrap-4.3.1-dist/js/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</body>

</html>