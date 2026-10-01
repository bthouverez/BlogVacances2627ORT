<section class="article" style="width: 700px; margin: 20px auto; min-height: 250px; border: 1px solid black; border-radius: 7px; padding: 25px; background: white">
	<h2><?= $article->getTitle() ?></h2>
	<h3>Posté le <?= $article->getCleanPostedAt() ?> par <?= $article->getUser()->getUsername() ?></h3>
	<p><img width="200" style="float: left; margin: 0 15px 5px 0" src="<?= $article->getImage() ?>" alt="image"><?= $article->getBody() ?></p>
</section>