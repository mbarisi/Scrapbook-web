<?php require_once 'view/_header.php'; ?>
<table>
	<tr><th>Autor</th><th>Odgovor</th></tr>
	<?php
		foreach( $QList as $page )
		{
			echo '<tr>' .
            '<td>'. $page->username . '</a></td>' .
			     '<td>'. $page->answer . '</a></td>' .
			     '</tr>';
		}
	?>
</table>

<form method="post" action="index.php?rt=page/get_Questions">
<button id="back" type="submit">Natrag na pitanja</button>
</form>

<?php require_once 'view/_footer.php'; ?>
