<?php
	/**
	 * 
	 */
	class Role
	{
		public $id;
		public $nom;
		public $slug;
		public $level;
		function __construct($id, $nom, $slug, $level)
		{
			$this->id=$id;
			$this->nom=$nom;
			$this->slug=$slug;
			$this->level=$level;
		}
		public function inserer_role($nom, $slug, $level){
			try{
			$PDO = new PDO("mysql:host=localhost; dbname=examen", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$req = $PDO->prepare("INSERT INTO roles(nom, slug, level) VALUES(:n, :s, :l)");
			$req->execute(array("n"=>$nom, "s"=>$slug, "l"=>$level));
			}
			catch(PDOExeption $e){
				echo $e->getMessage();
			}
		}
		public function afficher_role(){
			$PDO = new PDO("mysql:host=localhost; dbname=examen", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$req = $PDO->prepare("SELECT id, nom, slug, level FROM roles");
			$req->execute();
			$liste = array();
	        if($req != NULL)
	        {
	            while($objet = $req->fetch(PDO::FETCH_OBJ))
	            {
	                $p=new Categorie($objet->id, $objet->nom, $objet->slug, $objet->level);
	                $liste[]=$p;
	            }
	        }
	        return $liste;
		}

	}
?>