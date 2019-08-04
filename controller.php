<?php
require_once("class.membre.php");
require_once("class.categorie.php");
extract($_POST);
extract($_GET);
	if(isset($enregistrer_modif)){
			Membre::modifier_utilisateur($id, $login, $password, $adresse);
			header("Location:dashboard.php");
		}
	if(isset($id))
		{
			echo($id);
			Membre::supprimer_utilisateur($id);
			header("Location:dashboard.php");
		}
	if(isset($creer_utilisateur)){
		creer_utilisateur($login, $password, $adresse, $role);
		header("Location:dashboard.php");
	}
?>