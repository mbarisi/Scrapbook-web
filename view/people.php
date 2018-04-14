<?php require_once 'view/_header.php'; ?>

<div id="osobe">
		... koje su do sada ispunjavale Spomenar.
</div>

<table>
	<tr><th>Osobe</th></tr>
	<?php
for( $i=0; $i<sizeof($PeopleList); ++$i)
{
			echo '<tr>' .
        '<td><a href="index.php?rt=page/answers/'.$PeopleList[$i]->id_user.' ">' . $PeopleList[$i]->username . '</a></td>' .
			     '</tr>';
}
	?>
</table>

<?php require_once 'view/_footer.php'; ?>
