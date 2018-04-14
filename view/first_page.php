<?php require_once 'view/_header.php'; ?>



		<div id=pocetna>
			<br /><br />
			<p><em>Možete pogledati tko je sve odgovorio <br>
						na pitanja i sami ostaviti trag! :)   </em></p>
			<p> Za ispunjavanje spomenara i dodavanje <br>
						pitanja morate se ulogirati. </p>
						<?php

						if(!isset($_SESSION))
						{
							session_start();
						}

						if( !(isset( $_SESSION['username'] ) && isset( $_SESSION['id'] )) )
						{ ?>

						<form method="post" action="index.php?rt=login">
						<button id="gumb" type="submit">Ulogiraj se!</button>
					</form> <br>

						<?php
						}
						else
						{
							echo "<p id="."nesto"."> Bok, " . $_SESSION['username'] . "!</p>";
						}
						?>
			<br>
			<p> Za listanje po spomenaru pritisnite "Pregled".</p>


<form method="post" action="index.php?rt=page/begin">
<button id="gumb" type="submit">Pregled</button>
</form>


</div> <!-- end of home -->


<?php require_once 'view/_footer.php'; ?>
