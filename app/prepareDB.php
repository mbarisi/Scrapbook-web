<?php

// Manualno inicijaliziramo bazu ako već nije.
require_once '../model/db.class.php';

$db = DB::getConnection();

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS questions (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'question varchar(100) NOT NULL)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error #1: " . $e->getMessage() ); }

echo "Napravio tablicu questions.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS page_1 (' .
		'id_user int NOT NULL,' .
		'username varchar(20) NOT NULL, ' .
		'answer varchar(255) NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error #2: " . $e->getMessage() ); }

echo "Napravio tablicu page_1.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS page_2 (' .
		'id_user int NOT NULL,' .
		'username varchar(20) NOT NULL, ' .
		'answer varchar(255) NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error #2: " . $e->getMessage() ); }

echo "Napravio tablicu page_2.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS page_3 (' .
		'id_user int NOT NULL,' .
		'username varchar(20) NOT NULL, ' .
		'answer varchar(255) NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error #2: " . $e->getMessage() ); }

echo "Napravio tablicu page_3.<br />";

try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS page_4 (' .
		'id_user int NOT NULL,' .
		'username varchar(20) NOT NULL, ' .
		'answer varchar(255) NOT NULL )'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error #2: " . $e->getMessage() ); }

echo "Napravio tablicu page_4.<br />";


try
{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS log_users (' .
		'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
		'user varchar(20) NOT NULL,' .
		'password varchar(255) NOT NULL),' .
		'admin int NOT NULL)'
	);

	$st->execute();
}
catch( PDOException $e ) { exit( "PDO error #3: " . $e->getMessage() ); }

echo "Napravio tablicu log_users.<br />";


// Ubaci neka pitanja unutra
try
{
	$st = $db->prepare( 'INSERT INTO questions(question)
						VALUES (:question)' );

	$st->execute( array( 'question' => 'Kako se zoveš?' ) );
	$st->execute( array( 'question' => 'Gdje živiš?' ) );
	$st->execute( array( 'question' => 'Koliko imaš godina?' ) );
	$st->execute( array( 'question' => 'Koje boje su ti oči?' ) );


}
catch( PDOException $e ) { exit( "PDO error #4: " . $e->getMessage() ); }

echo "Ubacio pitanja u tablicu questions.<br />";

// Ubaci neke odgovore
try
{
	$st = $db->prepare( 'INSERT INTO page_1(id_user,username,answer) VALUES (:id_user, :username,:answer) ' );

	$st->execute( array( 'id_user' => '1', 'username' => 'Ana', 'answer' => 'Zovem se Ana.' ) );
	$st->execute( array( 'id_user' => '2', 'username' => 'Mirko', 'answer' => 'Zovem se Mirko.' ) );

}
catch( PDOException $e ) { exit( "PDO error #5: " . $e->getMessage() ); }

echo "Ubacio odgovore u tablicu page_1.<br />";

try
{
	$st = $db->prepare( 'INSERT INTO page_2(id_user,username,answer) VALUES (:id_user, :username,:answer) ' );

	$st->execute( array( 'id_user' => '1', 'username' => 'Ana', 'answer' => 'Živim u Zagrebu.' ) );
	$st->execute( array( 'id_user' => '2', 'username' => 'Mirko', 'answer' => 'U Varaždinu.' ) );

}
catch( PDOException $e ) { exit( "PDO error #5: " . $e->getMessage() ); }

echo "Ubacio odgovore u tablicu page_2.<br />";

try
{
	$st = $db->prepare( 'INSERT INTO page_3(id_user,username,answer) VALUES (:id_user, :username,:answer) ' );

	$st->execute( array( 'id_user' => '1', 'username' => 'Ana', 'answer' => 'Imam 25.godina' ) );
	$st->execute( array( 'id_user' => '2', 'username' => 'Mirko', 'answer' => 'Imam 15.godina' ) );

}
catch( PDOException $e ) { exit( "PDO error #5: " . $e->getMessage() ); }

echo "Ubacio odgovore u tablicu page_3.<br />";

try
{
	$st = $db->prepare( 'INSERT INTO page_4(id_user,username,answer) VALUES (:id_user, :username,:answer) ' );

	$st->execute( array( 'id_user' => '1', 'username' => 'Ana', 'answer' => 'Imam smeđe oči.' ) );
	$st->execute( array( 'id_user' => '2', 'username' => 'Mirko', 'answer' => 'Plave' ) );

}
catch( PDOException $e ) { exit( "PDO error #5: " . $e->getMessage() ); }

echo "Ubacio odgovore u tablicu page_4.<br />";

// Ubaci neke korisnike
try
{
	$st = $db->prepare( 'INSERT INTO log_users(user, password) VALUES (:user, :pass)' );

	$st->execute( array( 'user' => 'Ana', 'pass' => password_hash( 'passana', PASSWORD_DEFAULT ), 'admin' => 1 ) );
	$st->execute( array( 'user' => 'Marko', 'pass' => password_hash( 'passmarko', PASSWORD_DEFAULT ) 'admin' => 0) );
	$st->execute( array( 'user' => 'Tibor', 'pass' => password_hash( 'passtibor', PASSWORD_DEFAULT ) 'admin' => 0) );
	$st->execute( array( 'user' => 'Ena', 'pass' => password_hash( 'passena', PASSWORD_DEFAULT ) 'admin' => 0) );
}
catch( PDOException $e ) { exit( "PDO error #5: " . $e->getMessage() ); }

echo "Ubacio korisnike u tablicu log_users.<br />";

?>
