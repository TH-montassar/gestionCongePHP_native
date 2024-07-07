<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="Logo-Sesame.png" />
    <title>ajouter utilisateur</title>
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
            <a class="p-2 text-dark" href="profileRH.php">profil</a>
            <a class="p-2 text-dark" href="validationadmin.php">Validation</a>
            <a class="p-2 text-dark" href="consulter.php">consultation des demandes validées</a>
            <a class="p-2 text-dark" href="addUser.php">Ajouter utilisateur</a>
        </nav>
        <a class="btn btn-outline-success" href="Deconnexion.php">déconnexion</a>
    </div>
    <center>
        <div class="container">

            <div class="alert alert-dark" role="alert">
                <h3>Ajouter Utilisateur</h3>
            </div>
            <form method="POST" action="addNewUser.php">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputMatricule">
                            <h6>Matricule</h6>
                        </label>
                        <input type="text" class="form-control" id="inputMatricule" name="Matricule"
                            placeholder="Matricule">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNumeroTelephone">
                            <h6>Numero de Telephone</h6>
                        </label>
                        <input type="text" class="form-control" id="inputNumeroTelephone" name="NumeroTelephone"
                            placeholder="Numero de Telephone">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNom">
                            <h6>Nom</h6>
                        </label>
                        <input type="text" class="form-control" id="inputNom" name="nom" placeholder="Nom">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPrenom">
                            <h6>Prénom</h6>
                        </label>
                        <input type="text" class="form-control" id="inputPrenom" name="prenom" placeholder="Prénom">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputMail">
                            <h6>Mail</h6>
                        </label>
                        <input type="text" class="form-control" id="inputMail" name="mail" placeholder="mail">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputSolde">
                            <h6>sold de conge</h6>
                        </label>
                        <input type="text" class="form-control" id="inputSolde" name="SOLDE_CONGE"
                            placeholder="SOLDE_CONGE ">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPost">
                            <h6>Post</h6>
                        </label>
                        <select id="inputPost" name="role" class="form-control">
                            <option selected>Choisir..</option>
                            <option value="Responsable_achat">Responsable achat</option>
                            <option value="dev">dev</option>
                            <option value="ManagerQulity">ManagerQulity</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputRole">
                            <h6>Rôle</h6>
                        </label>
                        <select id="inputRole" name="role" class="form-control">
                            <option selected>Choisir..</option>
                            <option value="Responsable_RH">Responsable_RH</option>
                            <option value="Employe">Employe</option>
                            <option value="Manager">Manager</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Ajouter Utilisateur</button>
            </form>
        </div>
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