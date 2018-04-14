

<?php
if( isset( $_SESSION['username'] ) && isset( $_SESSION['id'] ) )
{	?>


	<form method="post" action="index.php?rt=page/newAnswer">
	Ime: <?php echo "<p class="."boldano".">". $_SESSION['username']. "</p>" ; ?>
	<input type="hidden" name="name" value="<?php echo $_SESSION['username'];?>" /><br>



	<?php

	if( !$ls->isAnswered($current) )
	{ ?>
		Unesi odgovor na pitanje: <br>
		<textarea name="answer" rows="4" cols="40" maxlength="1000"></textarea><br>
		<button id="gumb" type="submit">Pošalji</button>
		<?php
	}
	else
	{
		echo "<p class="."odgovorio_si"."> Odgovorio si!"."</p>";
	}
} ?>

</form>
