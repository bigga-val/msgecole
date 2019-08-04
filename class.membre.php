<?php
extract($_POST);
extract($_GET);
class Membre
	{
		public $id;
		public $login;
	    public $password;
	    public $adresse;
	    
	    public function __construct($id, $login, $password, $adresse)
	    {
	        $this->id = $id;
	        $this->login = $login;
	        $this->password = $password;
	        $this->adresse = $adresse;
	    }
	    function affiche_utilisateur(){
			$PDO = new PDO("mysql:host=localhost; dbname=examen", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$req = $PDO->prepare("SELECT id, login, password, adresse FROM users");
			$req->execute();
			$liste = array ();
	        if($req != NULL)
	        {
	            while($objet = $req->fetch(PDO::FETCH_OBJ))
	            {
	                $p=new Membre($objet->id, $objet->login, $objet->password, $objet->adresse);
	                $liste[]=$p;
	            }
	        }
	        return $liste;
			}
		public function modifier_utilisateur($id, $login, $password, $adresse)
		{
			try{
			$PDO = new PDO("mysql:host=localhost; dbname=examen", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$req = $PDO->prepare("UPDATE users SET login=:log, password=:pwd, adresse=:adr WHERE id=:id");
			$req->execute(array("log"=>$login, "pwd"=>$password, "adr"=>$adresse, "id"=>$id));
		}catch(PDOExeption $e){
			echo $e->getMessage();
		}
		}
		public function supprimer_utilisateur($id){
			$PDO = new PDO("mysql:host=localhost; dbname=examen", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$req = $PDO->prepare("DELETE FROM users WHERE id=".$id);
			//$req->execute(array("id"=>$id));
			$PDO->exec($req);
		}
		public function creer_utilisateur($login, $password, $adresse, $role)
		{
			try{
			$PDO = new PDO("mysql:host=localhost; dbname=examen", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$req = $PDO->prepare("INSERT INTO users(login, password, adresse, role_id) VALUES(:log, :pwd, :adr, :role)");
			$req->execute(array("log"=>$login, "pwd"=>$password, "adr"=>$adresse, "role"=>$role));
			}
			catch(PDOExeption $e){
				echo $e->getMessage();
			}
		}
		
	}
