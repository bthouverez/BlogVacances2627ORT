<h2>Tous les utilisateurs </h2>
<table style="background: white; margin: auto">
<tr><th>Utilisateur</th><th>Dernière connexion</th></tr>
<?php foreach($users as $user) { ?>
<tr class="user" style="width: 700px; margin: 20px auto; border: 1px solid black; border-radius: 7px; padding: 25px;">
	<td><h2><?= $user->getUsername() ?></h2></td>
	<td><h3><?= $user->getCleanLastConnection() ?></h3></td>
	<td>
		<form method="post" action="index.php">
			<button name="deleteUser" value="<?= $user->getId() ?>">X</button>
		</form>


	</td>
</tr>

<?php } ?>
</table>