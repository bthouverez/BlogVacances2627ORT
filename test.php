<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		body { background: #FF7700; }
	</style>
</head>
<body>


<?php
require_once 'model/UserDAO.php';
require_once 'model/ArticleDAO.php';
$daoUser = new UserDAO;
$u = $daoUser->getById(2);



$daoArticle = new ArticleDAO;
$a = $daoArticle->getById(2);
$articles = $daoArticle->getAll();


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


$users = $daoUser->getAll();



echo "<h1>Bonjour ". $u->getUsername()." </h1>";
?>


<form method="post" action="test.php">
	<input type="text" name="username" placeholder="Nom d'utilisateur">
	<input type="password" name="password" placeholder="Mot de passe">
	<input type="password" name="password_check" placeholder="Retapez le mot de passe">
	<button name="btnAjoutUser">Enregistrer</button>
</form>



<h2>Tous les utilisateurs </h2>
<table style="background: white; margin: auto">
<tr><th>Utilisateur</th><th>Dernière connexion</th></tr>
<?php foreach($users as $user) { ?>
<tr class="user" style="width: 700px; margin: 20px auto; border: 1px solid black; border-radius: 7px; padding: 25px;">
	<td><h2><?= $user->getUsername() ?></h2></td>
	<td><h3><?= $user->getCleanLastConnection() ?></h3></td>
</tr>

<?php } ?>
</table>





<form method="post" action="test.php">
	<input type="text" name="title" placeholder="Titre">
	<input type="text" name="body" placeholder="Corps">
	<input type="text" name="image" placeholder="Lien de l'image">
	<button name="btnAjoutArticle">Enregistrer</button>
</form>



<h2>Tous les articles </h2>

<?php  foreach($articles as $article) { ?>

<section class="article" style="width: 700px; margin: 20px auto; min-height: 250px; border: 1px solid black; border-radius: 7px; padding: 25px; background: white">
	<h2><?= $article->getTitle() ?></h2>
	<h3>Posté le <?= $article->getCleanPostedAt() ?> par <?= $article->getUser()->getUsername() ?></h3>
	<p><img width="200" style="float: left; margin: 0 15px 5px 0" src="<?= $article->getImage() ?>" alt="image"><?= $article->getBody() ?></p>
</section>
<?php } ?>

</body>
</html>
