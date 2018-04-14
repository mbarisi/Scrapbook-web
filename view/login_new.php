<?php require_once 'view/_header.php'; ?>

<script>
$(document).ready( function()
{
	$("#korisnicko_ime").on("input", provjeriIme);

	provjeriIme();

} );

provjeriIme = function()
{
		var input = $("#korisnicko_ime").val();

		if(/^[a-zA-Z0-9 čćžšđ]{1,20}$/.test( input ))
		{
			$( "#alert")
				.html("");
		}

		else
		{
			$( "#alert")
			.css("color", "red")
				.html("Korisničko ime se sastoji od slova i brojki!");
		}
}
</script>

<div id="unos_odgovora">

	<form method="post" action="index.php?rt=login/newUser">
		Novo korisničko ime:
		<input id="korisnicko_ime" type="text" name="username"><br><br> <p id="alert"></p>
		Odaberite lozinku:
		<input type="password" name="password"><br><br>
		<button id="gumb" type="submit">Stvori korisnički račun!</button><br><br>
	</form>

	<nav>	<a href="index.php?rt=page">Natrag</a> </nav>

</div>


<?php require_once 'view/_footer.php'; ?>
