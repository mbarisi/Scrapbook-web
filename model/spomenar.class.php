<?php

require_once 'db.class.php';
require_once 'page.class.php';
require_once 'question.class.php';


class Spomenar
{
	//ukupan broj stranica
	function getMaxPage()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT question FROM questions' );
			$st->execute( array( ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$brojac = 0;
		while( $row = $st->fetch() )
			++$brojac;

		return $brojac;

	}

	//dohvati pitanja
	function getQuestion( $nb )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT question FROM questions WHERE id=:id' );
			$st->execute( array( 'id' => $nb ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		return $row['question'];
	}

	//dohvati stranicu
	function getPage( $nb )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id_user, username, answer FROM page_' . $nb );
			$st->execute( array( ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Page( $row['id_user'], $row['username'], $row['answer'] );
		}

		return $arr;
	}


	//dodaj novog usera u bazu
	function addNewUser( $username, $password )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT user FROM log_users WHERE user=:user' );
			$st->execute( array( 'user' => $username ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		if( $st->rowCount() !== 0  )
			return false;

		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'INSERT INTO log_users(user,password, admin) VALUES(?,?,?)' );
			$st->execute( array( $username,  password_hash( $password, PASSWORD_DEFAULT ),0) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }


		return true;
	}

	//login postojećeg usera
	function Login( $username, $password )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id,user, password, admin FROM log_users WHERE user=:user' );
			$st->execute( array( 'user' => $username ) );
		}
		catch( PDOException $e ) { exit( 'Greška u bazi: ' . $e->getMessage() ); }

		$row = $st->fetch();

		if( $row === false )
			return false;

		if( !password_verify( $password, $row['password'] ) )
			return false;

		session_start();

		$_SESSION['username'] = $username;
		$_SESSION['id'] = $row['id'];
		$_SESSION['admin'] = $row['admin'];

		return true;

	}

	// dodaj odgovor
	function addAnswer( $page,$answer )
	{
		session_start();
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'INSERT INTO page_' . $page . '(id_user,username,answer) VALUES(?,?,?)' );
			$st->execute( array( $_SESSION['id'], $_SESSION['username'], htmlentities($answer) ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
	}

	//da li je odgovoreno na pitanje
	function isAnswered( $current )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id_user FROM page_' . $current . ' WHERE id_user LIKE :id' );
			$st->execute( array( 'id' => $_SESSION['id'] ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return false;
		return true;
	}

	//dodaj novo pitanje u bazu
	function addQuestion( $page, $question )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'INSERT INTO questions(question) VALUES(:question)' );
			$st->execute( array( 'question' => $question ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		//napravi tablicu
		try
		{
			$st = $db->prepare(
				'CREATE TABLE IF NOT EXISTS page_'. $page .' (' .
				'id_user int NOT NULL,' .
				'username varchar(20) NOT NULL, ' .
				'answer varchar(255) NOT NULL )'
			);
			$st->execute();
		}
		catch( PDOException $e ) { exit( "PDO error #2: " . $e->getMessage() ); }

		return true;
	}

	//dohvati sva pitanja (bookmark)
	function get_Questions()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM questions' );
			$st->execute( array( ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Question( $row['id'], $row['question']);
		}

		return $arr;
	}

//dohvati usere (bookmark)
function getPeople()
{
	try
	{
		$db = DB::getConnection();
		$st = $db->prepare( 'SELECT id_user, username, answer FROM page_1' );
		$st->execute( array( ) );
	}
	catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

	$arr = array();
	while( $row = $st->fetch() )
	{
		$arr[]= new Page ( $row['id_user'], $row['username'], $row['answer'] );

	}

	return $arr;
}

//dohvati odgovore (bookmark)
function answers( $id )
{
	$sviOdgovori = array();
	try
	{
		for($i=1; $i<=$this->getMaxPage(); $i++)
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM page_'.$i.' WHERE id_user LIKE :id' );
			$st->execute( array( 'id' =>$id ) );

			$arr = array();
			$row = $st->fetch();

			if( ! $row )
					$var = new Page( $row['id_user'], $row['username'], '---' );

			else
					$var = new Page( $row['id_user'], $row['username'], $row['answer'] );

			$sviOdgovori[$i] = $var;

		}
	}
	catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

	return $sviOdgovori;
}

};

?>
