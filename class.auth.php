<?php 
		extract($_POST);
		extract($_GET);
	/**
	 * 
	 */
	class Auth
	{
		public $id;
		public $login;
	    public $password;
	    public $adresse;

	    
	    public function __construct()
	    {
	        /*$this->id = $id;
	        $this->login = $login;
	        $this->password = $password;
	        $this->adresse = $adresse;*/
	    }
		function login($log, $pwd){
			try{
			$PDO = new PDO("mysql:host=localhost; dbname=examen", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$req = $PDO->prepare("SELECT users.id, users.login, users.adresse, roles.nom, roles.slug FROM users LEFT JOIN roles ON users.role_id=roles.id WHERE login=:d AND password=:c");
			$req->execute(array("d"=>$log, "c"=>$pwd));
			$data = $req->fetchAll();
			//print_r($data);
			}
			catch(PDOExeption $e)
			{
				echo "connection impossible";
			}
			if(count($data)>0){
				$_SESSION["Auth"]=$data[0];
				//return true;
			}else{
				//echo "mauvais identifiant";
			}

		}
		function Allow(){
			$PDO = new PDO("mysql:host=localhost; dbname=examen", "root", "");
			$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			$req = $PDO->prepare("SELECT level, slug FROM roles");
			$req->execute();
			$data = $req->fetchAll();
			//print_r($data);
		}
		function user(){
			if(isset($_SESSION["Auth"]->slug)){
				return $_SESSION["Auth"]->slug;
			}else{
				return false;
			}
		}
		function deconnecte(){
			if(isset($_SESSION["Auth"]->slug)){
				session_unset();
				header("Location: login.php");
			}
		}
		
	}
$Auth = new Auth();

