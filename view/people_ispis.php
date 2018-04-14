<?php require_once 'view/_header.php'; ?>

<table id="people_ispis_lijeva_strana">	<tr><th>Pitanje</th></tr>

	<?php
foreach( $QsList as $Qs )
{
		echo '<tr>' .
				 '<td>' . $Qs->question . '</td></tr>' ;

} ?>
</table>

<table id="people_ispis_desna_strana"> <tr><th>Odgovori</th></tr>

<?php  

foreach( $AsList as $As )
{

		echo  '<tr><td>' . $As->answer . '</td>' .
				  '</tr>';
}
	?>
</table>

<form method="post" action="index.php?rt=page/getPeople">
<button id="back" type="submit">Natrag na osobe</button>
</form>

<?php require_once 'view/_footer.php'; ?>
