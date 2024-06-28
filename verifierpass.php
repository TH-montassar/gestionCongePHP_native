<?php
	$serveur= "localhost";
	$login="root";
	$pass="";
	session_start();
		$_SESSION['mat']=$_POST['mat'];
		$_SESSION['pass']=$_POST['pass'];
		$id=$_SESSION['mat'];
	if($_POST["remember"]=='1' || $_POST["remember"]=='on')
        {
            $hour = time() + 3600 * 24 * 30;
            setcookie('matricule', $_SESSION['mat'], $hour);
            setcookie('password', $_SESSION['pass'], $hour);
        }

			try {
				$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
				$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					$r="SELECT ROLE, MOT_DE_PASSE from UTILISATEUR Where MATRICULE=$id";
					$r=$connexion->prepare($r);
					$r->execute();
					$r=$r->fetchall();
				if (count($r)>0 && password_verify($_SESSION['pass'],$r[0][1]))
				{
					if ($r[0][0]=="Manager") {
						header("location:profilchef.php");
					}elseif ($r[0][0]=="Responsable_RH") {
						header("location:profiladmin.php");
					}else{
						header("location:profil.php");}
				}else{
					header("location:Index.php?incorrect=1");
				}
			}
		 	catch (PDOException $e) {
				echo  'Echec:'.$e->getmessage();
			}
?>