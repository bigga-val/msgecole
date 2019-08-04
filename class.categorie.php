<?php
	/**
	 * 
	 */
	class Categorie
	{
		public $id;
		public $nom_categorie;
		function __construct($id, $nom_categorie)
		{
			$this->id = $id;
			$this->nom_categorie = $nom_categorie;
		}
		public function afficher_categorie(){
			$PDO = new PDO("mysql:host=localhost; dbname=examen", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$req = $PDO->prepare("SELECT id, nom_categorie FROM categorie");
			$req->execute();
			$liste = array();
	        if($req != NULL)
	        {
	            while($objet = $req->fetch(PDO::FETCH_OBJ))
	            {
	                $p=new Categorie($objet->id, $objet->nom_categorie);
	                $liste[]=$p;
	            }
	        }
	        return $liste;
		}
	}

?>