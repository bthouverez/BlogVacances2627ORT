<?php

require_once('Article.php');

class ArticleDAO {

	private PDO $con;

	public function __construct() {
		try {
			$this->con = new PDO('mysql:dbname=BlogVacances2627;host=127.0.0.1', 'bthouverez', '321654');
		} catch(Exception $e) {
			die('ERROR CONNEXION DB : '. $e->getMessage() );
		}
	}


	public function getById(int $i): Article {
		$sql = 'SELECT * FROM articles a 
		INNER JOIN users u ON a.idUser = u.id
		WHERE a.id = ?;';
		$stmt = $this->con->prepare($sql);
		$stmt->execute([$i]);

		$data = $stmt->fetch();
		$article = new Article;

		if($data) {
			$article->setId($data['id']);
			$article->setTitle($data['title']);
			$article->setBody($data['body']);
			$article->setImage($data['image']);
			$article->setPostedAt($data['postedAt']);

			$u = new User;

			$u->setId($data['id']);
			$u->setUsername($data['username']);
			$u->setPassword($data['password']);
			$u->setLastConnection($data['lastConnection']);

			$article->setUser($u);
		}

		return $article;
	}

	public function getAll() : array {
		// faire la requete SQL pour récupérer tous les articles (avec l'auteur)
		$sql = 'SELECT * FROM articles a JOIN users u ON u.id = a.idUser;';
		//$stmt = $this->con->prepare($sql);
		//$stmt->execute();
		$stmt = $this->con->query($sql);
		
		$u = null;
		$tab = [];

		// parcourir le résultat de la requete (plusieurs lignes)
		foreach($stmt->fetchAll() as $tabArticle) {
			// créer un DTO article, le mettre a jour
			$a = new Article;
			$a->setId($tabArticle['id']);
			$a->setTitle($tabArticle['title']);
			$a->setBody($tabArticle['body']);
			$a->setImage($tabArticle['image']);
			$a->setPostedAt($tabArticle['postedAt']);

			// créer un DTO user pour l'auteur, et l'associer à l'article
			$u = new User;
			$u->setId($tabArticle[0]);
			$u->setUsername($tabArticle['username']);
			$u->setPassword($tabArticle['password']);
			$u->setLastConnection($tabArticle['lastConnection']);
			$a->setUser($u);

			// mettre cet article dans un tableau
			$tab[] = $a;
		}

		// renvoyer le tableau
		return $tab;
	}


	public function create(Article $article) {
		// Exrait les informations de l'article passé en paramètre

		// Insère les infos extraites dans la BDD

		// La fonction renvoie l'id de l'article nouvellement créé
	}
}