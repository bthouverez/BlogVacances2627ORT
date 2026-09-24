<?php

require_once 'User.php';

class UserDAO {

	private PDO $con;

	public function __construct() {
		try {
			$this->con = new PDO('mysql:dbname=BlogVacances2627;host=127.0.0.1', 'bthouverez', '321654');
		} catch(Exception $e) {
			die('ERROR CONNEXION DB : '. $e->getMessage() );
		}
	}

	public function getById(int $i) : User {
		// requête SQL
		$sql = 'SELECT * FROM users u
		INNER JOIN articles a ON u.id = a.idUser WHERE u.id = ?';
		$stmt = $this->con->prepare($sql);
		$stmt->execute([$i]);

		// parcourir le résultat de la requête (un vieu tableau PHP tout pourri)
		$tab = $stmt->fetchAll();

		// créer un bel objet BO User
		if(count($tab)) {
			$user = new User($tab[0]['id'], $tab[0]['username'], $tab[0]['password'], $tab[0]['lastConnection']);
			foreach($tab as $tabArticle) {
				$a = new Article();
				$a->setId($tabArticle['id']);
				$a->setTitle($tabArticle['title']);
				$a->setBody($tabArticle['body']);
				$a->setImage($tabArticle['image']);
				$a->setPostedAt($tabArticle['postedAt']);

				$user->addArticle($a);
			}
		} else {
			$user = new User();
		}
		
		// renvoyer le User
		return $user;
	}

		public function getAll() : array {


		// faire la requete SQL pour récupérer tous les users (avec leur articles)
		// $sql = "SELECT * FROM users u JOIN articles a ON a.idUser = u.id";
		$sql = "SELECT * FROM users";
		$stmt = $this->con->query($sql);
		$tab = [];

		// parcourir le résultat de la requete (plusieurs lignes)
			foreach($stmt->fetchAll() as $tabUser) {
			// créer un DTO user 
				$u = new User;
				$u->setId($tabUser['id']);
				$u->setUsername($tabUser['username']);
				$u->setPassword($tabUser['password']);
				$u->setLastConnection($tabUser['lastConnection']);
			
				// créer des DTO articles à associer au user
				// ...

				// mettre cet user dans un tableau
				$tab[] = $u;
			}		



		// renvoyer le tableau
		return $tab;
	}

	public function create(User $user) {
		// Exrait les informations de l'utilisateur passé en paramètre

		// Insère les infos extraites dans la BDD

		// La fonction renvoie l'id de l'utilisateur nouvellement créé
	}
}