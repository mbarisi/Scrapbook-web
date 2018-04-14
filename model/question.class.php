<?php

class Question
{
	protected $id, $question;

	function __construct( $id, $question )
	{
		$this->id = $id;
		$this->question = $question;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
