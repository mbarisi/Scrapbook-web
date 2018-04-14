<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>Spomenar</title>
	<link type="text/css" rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.js"></script>
</head>
<body>



<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if( isset( $_SESSION['username'] ) && isset( $_SESSION['id'] ) )
	{

		echo "<p id="."korisnik"."> Korisnik: ". $_SESSION['username']. ".</p>" ; ?>

		<form  method="post" action="index.php?rt=login/logout">
		<button id="gumb" type="submit">Logout</button>
		</form>

<?php
	}
	?>

			<div id="slider">
					<div id="knjiga">

							<div id="bookmarksi">

			            <div id="header">
			                <h1>Spomenar</h1>
										<div id="naslov">	<?php echo "<h3>" . $title . "</h3>"; ?> </div>
			            </div>

			            <div id="menu">
			                <ul class="navigation">
			                    <li><a href="index.php?rt=page" class="menu_01">Dobrodošli</a></li>
			                    <li><a href="index.php?rt=page/get_Questions" class="menu_01">Pitanja</a></li>
			                    <li><a href="index.php?rt=page/getPeople" class="menu_01">Osobe</a></li>
			                    <li><a href="index.php?rt=page/crtez" class="menu_01">Ostavite trag</a></li>
			                    <li><a href="index.php?rt=page/contact" class="menu_01">Kontakt</a></li>
			                </ul>
			            </div>
						 </div> <!-- end of bookmarsi -->
