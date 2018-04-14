<?php

class IndexController
{
	public function index()
	{
		// ... preusmjeravanje
		header( 'Location: index.php?rt=page' );
	}
};

?>
