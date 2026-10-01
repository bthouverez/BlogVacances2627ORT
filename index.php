<?php

require_once 'model/UserDAO.php';
require_once 'model/ArticleDAO.php';

$daoUser = new UserDAO;
$daoArticle = new ArticleDAO;


// conenxion d'un user
$u = $daoUser->getById(2);


include('view/head.php');
include('view/hello.php');


// Traiter l'ajout d'un user
if(isset($_POST['btnAjoutUser'])) {
	if( !empty($_POST['username']) && 
		!empty($_POST['password'])  && 
		!empty($_POST['password_check'])) {
		if($_POST['password'] == $_POST['password_check']) {
			$u = new User;
			$u->setUsername($_POST['username']);
			$u->setPassword($_POST['password']);
			$u->setLastConnection(date('Y-m-d h:i:s'));

			$daoUser->create($u);
			echo 'Utilisateur ajouté dans la base';

		} else { echo 'Les mots de passe ne correspondent pas'; }
	}
}

// Traiter l'ajout d'un article
if(isset($_POST['btnAjoutArticle'])) {
	if( !empty($_POST['title']) && 
		!empty($_POST['body'])) {
		$a = new Article;
		$a->setTitle($_POST['title']);
		$a->setBody($_POST['body']);
		$a->setImage($_POST['image']);

		$daoArticle->create($a);
		echo 'Article ajouté dans la base';
	}
}

if(isset($_POST['deleteUser'])) {
	$daoUser->delete($_POST['deleteUser']);
	$users = $daoUser->getAll();
	include('view/showUsers.php');
}


if(isset($_GET['addUser'])) {
	include('view/formAddUser.php');
}

if(isset($_GET['users'])) {
	$users = $daoUser->getAll();
	include('view/showUsers.php');
}

// Traitement d'une requête GET pour accéder au formulaire d'ajout d'un article
if(isset($_GET['addArticle'])) {
	include('view/formAddArticle.php');
}

// Traitement d'une requête GET pour aller voir les articles
if(isset($_GET['articles'])) {
	$articles = $daoArticle->getAll();
	include('view/showArticles.php');
}

include('view/foot.php');






