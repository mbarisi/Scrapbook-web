<?php

require_once 'model/spomenar.class.php';

class LoginController
{
	public function index()
	{

		$title = 'Ulogirajte se!';

		require_once 'view/login_index.php';
	}

	//registriraj novog korisnika
	public function Register()
	{
		$title = "Novi korisnik";

		require_once 'view/login_new.php';
	}

	//dodaj ga u bazu
	public function NewUser()
	{
		$ls = new Spomenar();

		//provjeri da li su postavljeni usename ili password
		if( !isset( $_POST['username'] ) || !isset( $_POST['password']) || $_POST['password'] === '' )
		{
			//... preusmjeri ako nema problema
			header( 'Location: index.php?rt=login/Input');
			exit();
		}

		//Je li ime ok?
		if( !preg_match( '/^[a-zA-Zčćžšđ]{1,20}$/', $_POST['username'] ) )
		{
			header( 'Location: index.php?rt=login/Preg');
			exit();
		}

		//Je li password ok?
		if( !preg_match( '/^[a-zA-Z0-9]+$/', $_POST['password'] ) )
		{
			header( 'Location: index.php?rt=login/Preg2');
			exit();
		}

		//probaj dodati novog usera
		$i = $ls->addNewUser( $_POST['username'], $_POST['password'] );

		//dodavanje nije uspjesno
		if( !$i )
		{
			header( 'Location: index.php?rt=login/Wrong2');
			exit();
		}

		//ako je sve ok, ulogiraj se
		header( 'Location: index.php?rt=login/Login');

	}


	//login postojećih korisnika
	public function Login()
	{
			$ls = new Spomenar();

			//ako username ili password nisu poslani
			if( !isset( $_POST['username'] ) || !isset( $_POST['password'] ) )
			{
				header( 'Location: index.php?rt=login');
				exit();
			}

			//ako je username ok
			if( !preg_match( '/^[a-zA-Zčćžšđ]{1,20}$/', $_POST['username'] ) )
			{
				header( 'Location: index.php?rt=login/Input2');
				exit();
			}

			//probaj se ulogirati
			$i = $ls->Login($_POST['username'], $_POST['password']);

			//ako login nije uspio
			if( !$i )
			{
				header( 'Location: index.php?rt=login/Wrong');
				exit();
			}

		header( 'Location: index.php?rt=page');
	}

	//krivo uneseni password ili korisničko ime pri registraciji
	public function Wrong()
	{
		$title = "Krivi username ili password, pokušaj ponovno";
		require_once 'view/login_index.php';
	}

	public function Wrong2()
	{
		$title = "Registracija neuspjela,ime zauzeto";
		require_once 'view/login_index.php';
	}

	//nije uneseno i korisnicko ime i password pri registraciji
	public function Input()
	{
		$title = "Unesi korisničko ime i password";
		require_once 'view/login_new.php';
	}

	//preg match za ulogiravanje
	public function Input2()
	{
		$title = "Korisničko ime mora biti do 20 slova";
		require_once 'view/login_index.php';
	}

	//preg match pri registraciji
	public function Preg()
	{
		$title = "Korisničko ime mora biti do 20 slova";
		require_once 'view/login_new.php';
	}

	public function Preg2()
	{
		$title = "Password mora sadržavati slova ili brojke";
		require_once 'view/login_new.php';
	}


	//logout
	public function Logout()
	{
		session_start();

		session_unset();
		session_destroy();

		header( 'Location: index.php?rt=page' );
		exit();
	}


};

?>
