<?php

require_once 'model/spomenar.class.php';

class PageController
{
	public function index()
	{

		$title = 'Dobro došli!';

		require_once 'view/first_page.php';
	}

	public function begin()
	{
		$ls = new Spomenar();
		//postavi trenutnu stranicu u cookie
		setcookie( 'current_page', 1, time()+60*60*24, "/" ); //set cookie na 24 sata
		$current = 1;
		$title = $ls->getQuestion(1);
		$PageList = $ls->getPage(1);

		require_once 'view/page_index.php';
	}

	public function next()
	{
		$ls = new Spomenar();

		//broj trenutne stranice
		$current = $_COOKIE['current_page'];
		$current++;
		setcookie( 'current_page', $current, time()+60*60*24, "/" ); //set cookie na 24 sata

		//broj zadnje stranice
		$last_page = $ls->getMaxPage();

		//zadnja stranica
		if( $current === $last_page+1 )
		{
			$title = "Spomenar";
			require_once 'view/last_page.php';
			exit(1);
		}

		//naslov trenutne stranice
		$title = $ls->getQuestion($current);
		$PageList = $ls->getPage($current);

		require_once 'view/page_index.php';
	}

	public function back()
	{
		$ls = new Spomenar();

		//dohvati trenutnu stranicu
		$current = $_COOKIE['current_page'];
		$current--;

		//ako je stranica 0, odi na početnu
		if( $current === 0 )
		{
			header( 'Location: index.php?rt=page' );
			exit(1);
		}

		setcookie( 'current_page', $current, time()+60*60*24, "/" ); //set cookie na 24 sata

		$title = $ls->getQuestion($current);
		$PageList = $ls->getPage($current);

		require_once 'view/page_index.php';
	}

	//dodaj novo pitanje
	public function newAnswer()
	{
		$ls = new Spomenar();

		$current = $_COOKIE['current_page'];

		$ls->addAnswer($current,$_POST['answer'] );

		//naslov
		$title = $ls->getQuestion($current);
		$PageList = $ls->getPage($current);

		//broj zadnje stranice
		$last_page = $ls->getMaxPage();

		//... zadnja stranica
		if( $current === $last_page )
		{
			require_once 'view/last_page.php';
			exit(1);
		}
		require_once 'view/page_index.php';
	}

	//dodajemo novo pitanje u bazu podataka
	public function addQuestion()
	{
		$ls = new Spomenar();

		$last_page = $ls->getMaxPage();
		$current = $last_page+1;
		setcookie( 'current_page', $current, time()+60*60*24, "/" ); //set cookie na 24 sata

		$ls->addQuestion($current,$_POST['question']);

		$title = $ls->getQuestion($current);
		$PageList = $ls->getPage($current);

		require_once 'view/page_index.php';
	}

	//dohvati pitanja
	public function get_Questions()
	{
		$ls = new Spomenar();


		$title = 'Pitanja';
		$QuestionList= $ls->get_Questions();

		require_once 'view/question.php';
	}

	// dohvati osobe
	public function getPeople()
	{
			$ls = new Spomenar();
			$title= 'Osobe';
			$PeopleList= $ls->getPeople();

			require_once 'view/people.php';
	}

	// za kontakt formu
	public function contact()
	{

		$title = 'Informacije za kontakt';

		require_once 'view/contact_page.php';
	}

	// za crtanje
	public function crtez()
	{
		$title = '';

		require_once 'view/canvas_page.php';

	}

	// za kontakt formu
	public function mail()
	{
		$title = '';

		$emailTo = 'martinabarisic7@gmail.com';
    $body = "Name: ".$_POST['author']." \n\nEmail: ".$_POST['email']." \n\nSubject: ".$_POST['subject']." \n\nText:\n ".$_POST['text'];
    $headers = 'From: Spomenar <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $_POST['email'];
		$subject = $_POST['subject'];
    mail($emailTo, $subject , $body, $headers);
    $emailSent = true;

		require_once 'view/contact_page.php';

	}

	// za ispis pitanja(bookmark)
	public function quest()
	{
		$route = $_GET['rt'];
		$parts = explode( '/', $route );
		$id = $parts[2];

		$title = '';
		$ls = new Spomenar();
		$QList= $ls->getPage($id);
		require_once 'view/question_ispis.php';

	}

	//za ispis odgovora (bookmark)
	public function answers()
	{
		$route = $_GET['rt'];
		$parts = explode( '/', $route );
		$id = $parts[2];

		$title = '';
		$ls = new Spomenar();
		$AsList= $ls->answers($id);
		$QsList = $ls->get_Questions();
		require_once 'view/people_ispis.php';


	}

};

?>
