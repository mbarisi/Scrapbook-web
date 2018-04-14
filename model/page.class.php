<?php

class Page
{
	protected $id_user, $username, $answer;

	function __construct( $id_user, $username, $answer )
	{
		$this->id_user = $id_user;
		$this->username = $username;
		$this->answer = $answer;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
