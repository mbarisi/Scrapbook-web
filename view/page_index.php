<?php require_once 'view/_header.php'; ?>

<div id="tablica">

<table>
	<tr><th>Autor</th><th>Odgovor</th></tr>
	<?php
		foreach( $PageList as $page )
		{
			echo '<tr>' .
			     '<td>' . $page->username . '</td>' .
			     '<td>' . $page->answer . '</td>' .
			     '</tr>';
		}
	?>
</table>

</div>

<div id="unos_odgovora">

<?php

if(!isset($_SESSION))
{
	session_start();
}

require_once 'view/answer_sheet.php';

if( isset( $_SESSION['username'] ) && isset( $_SESSION['id'] ) )
{ ?>


<?php
}
?>
</div>

<form method="post" action="index.php?rt=page/back">
<button id="back" type="submit">Back</button>
</form>
<form method="post" action="index.php?rt=page/next">
<button  id="next" type="submit">Next</button>
</form>

<?php require_once 'view/_footer.php'; ?>
