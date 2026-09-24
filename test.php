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
		body { background: #FF7700;
		}
	</style>
</head>
<body>


<?php

require_once 'model/UserDAO.php';
require_once 'model/ArticleDAO.php';
$daoUser = new UserDAO;
$u = $daoUser->getById(2);
$users = $daoUser->getAll();



$daoArticle = new ArticleDAO;
$a = $daoArticle->getById(2);
$articles = $daoArticle->getAll();

echo "<h1>Bonjour ". $u->getUsername()." </h1>";
echo "<h2>Tous les utilisateurs </h2>";
foreach($users as $user) { ?>
<section class="user" style="width: 700px; margin: 20px auto; min-height: 250px; border: 1px solid black; border-radius: 7px; padding: 25px; background: white">
	<h2><?= $user->getUsername() ?></h2>
	<h3>Co,nnecté pour la denière fois le <?= $user->getlastConnection() ?></h3>
</section>
<?php }


echo "<h2>Tous les articles </h2>";

foreach($articles as $article) { ?>

<section class="article" style="width: 700px; margin: 20px auto; min-height: 250px; border: 1px solid black; border-radius: 7px; padding: 25px; background: white">
	<h2><?= $article->getTitle() ?></h2>
	<h3>Posté le <?= $article->getCleanPostedAt() ?> par <?= $article->getUser()->getUsername() ?></h3>
	<p><img width="200" style="float: left; margin: 0 15px 5px 0" src="<?= $article->getImage() ?>" alt="image"><?= $article->getBody() ?></p>
</section>


<?php }
/*
require_once 'model/User.php';

$u = new User(7, 'bob', 'bib', '2026-09-10');
echo $u;

echo '<br><br>';

$u = new User();
echo $u;



*/
?>


</body>
</html>