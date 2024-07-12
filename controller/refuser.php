<?php
	session_start();
	$id=$_GET['ID'];
	$E=$_GET['E'];
	$MAT=$_GET['MAT'];
	$NOMBRE_JOUR=$_GET['N'];
	try{
		$serveur="localhost";
		$login="root";
		$pass="";
			$connexion = new PDO("mysql:host=$serveur;dbname=gestionconge",$login,$pass);
			$connexion->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$requete0=$connexion->prepare("SELECT SOLDE_CONGE from UTILISATEUR where MATRICULE=$MAT");
			$requete0->execute();
			$requete0=$requete0->fetchall();
			$SOLDE_CONGE=$requete0[0][0];

			$requet1=$connexion->prepare("UPDATE CONGE SET ETAT = 'Rejected' where ID_CONGE=$id");
			$requet1->execute();
				$NNB_J=$SOLDE_CONGE+$NOMBRE_JOUR;
				$requete2=$connexion->prepare("UPDATE UTILISATEUR SET SOLDE_CONGE=$NNB_J where MATRICULE=$MAT");
				$requete2->execute();
			if ($E==1) {
				header("location:../validationadmin.php");
			}else{header("location:../validationchef.php");}
	}
	catch(PDOEXEPTION $e){
		echo'echec:'.$e->get_message();
	}
?>