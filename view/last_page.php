<?php require_once 'view/_header.php'; ?>

<div id="unos_pitanja">

Došli ste do kraja spomenara! <br><br>


<?php
	if( !isset($_SESSION) )
	{
		session_start();
	}
	if( isset( $_SESSION['username'] ) && isset( $_SESSION['id'] ) &&
	 			$_SESSION['admin'] == 1 )
	{
			echo '<br>'."Unesite novo pitanje ako želite. :)"?>

			<br>
			<form method="post" action="index.php?rt=page/addQuestion">
				<input type="text" name="question"> <br>
				<input id ="gumb" type="submit" value="Pošalji"></input>
			</form>

<?php
	}
?>
<br><br>
<form method="post" action="index.php?rt=page/back">
<button id="gumb" type="submit">Back</button>
</form>

</div>

<?php require_once 'view/_footer.php'; ?>
