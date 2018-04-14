<?php require_once 'view/_header.php'; ?>


<div id="unos_odgovora">

	<form method="post" action="index.php?rt=login/Login">
		Korisničko ime:
		<input type="text" name="username"><br>
		Lozinka:
		<input type="password" name="password"><br><br>
		<button id="gumb" type="submit">Ulogiraj se!</button>
	</form>

	
	<br>
	<p>
		<form method="post" action="index.php?rt=login/Register">
		Ako nemate korisnički račun, registrirajte se. <br>
		<br><button id="gumb" type="submit">Registriraj se!</button><br>
	</p>
<br>
<nav><a href="index.php?rt=page">Natrag</a></nav>

</div>

<?php require_once 'view/_footer.php'; ?>
