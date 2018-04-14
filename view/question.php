<?php require_once 'view/_header.php'; ?>

<div id="osobe">
	<br>...koja se nalaze u Spomenaru. Klikom na pitanje
	<br> pogledajte sve odgovore.
</div>


<table>
	<tr><th>Pitanje</th></tr>
	<?php
		foreach( $QuestionList as $page )
		{
			echo '<tr>' .
			     '<td><a href="index.php?rt=page/quest/'.$page->id.' ">'. $page->question . '</a></td>' .
			     '</tr>';
		}
	?>
</table>

<?php require_once 'view/_footer.php';?>
