<?php
	/**
	 * 
	 */
	class Commentaire
	{
		public $id;
		public $id_user;
		public $commentaire;
		public $id_categorie;
		
		function __construct($id, $id_user, $commentaire, $id_categorie)
		{
			$this->id = $id;
			$this->id_user = $id_user;
			$this->commentaire = $commentaire;
			$this->id_categorie = $id_categorie;
		}
		public function afficher_commentaire(){
			$PDO = new PDO("mysql:host=localhost; dbname=examen", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$req = $PDO->prepare("SELECT commentaires.id, users.login, commentaires.commentaire, categorie.nom_categorie FROM users, commentaires, categorie WHERE commentaires.id_user=users.id and commentaires.id_categorie");
			$req->execute();
			$liste = array ();
	        if($req != NULL)
	        {
	            while($objet = $req->fetch(PDO::FETCH_OBJ))
	            {
	                $p=new Commentaire($objet->id, $objet->login, $objet->commentaire, $objet->categorie);
	                $liste[]=$p;
	            }
	        }
	        return $liste;
			}

	}
?>