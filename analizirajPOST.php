<?php

function analiziraj_POST_login()
{
	// Analizira $_POST iz forme za login

	if( !isset( $_POST['Prezime'] ) || !isset( $_POST['Lozinka'] ) )
	{
		crtaj_formaZaLogin( 'Trebate unijeti korisničko ime i lozinku.' );
		exit();
	}

	if( !preg_match( '/^[a-zA-Z]{3,10}$/', $_POST['Prezime'] ) )
	{
		crtaj_formaZaLogin( 'Korisničko ime treba imati između 3 i 10 slova.' );
		exit();
	}

	// Dakle dobro je korisničko ime. 
	// Provjeri taj korisnik postoji u bazi; dohvati njegove ostale podatke.
	$user = 'student'; 
	$pass = 'pass.mysql'; 

	try 
	{

		$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
	} 
	catch( PDOException $e ) 
	{
		echo "Greška: " . $e->getMessage(); exit();
	}

	try
	{
		$st = $db->prepare( 'SELECT * FROM Korisnik WHERE Prezime=:Prezime AND Lozinka=:Lozinka' );
		$st->execute( array( 'Prezime' => $_POST['Prezime'] ,'Lozinka' => $_POST['Lozinka']  ) );
	
	
	}
	catch( PDOException $e ) { exit( 'Greška u bazi: ' . $e->getMessage() ); }

	$row = $st->fetch();


	if( $row === false )
	{
		crtaj_formaZaLogin( 'Krivo korisničko ime ili lozinka!.' );
		exit();
	}


	else
	{
		// Sad je valjda sve OK. Ulogiraj ga.
		$_SESSION['Prezime'] = $_POST['Prezime'];
		crtaj_ulogiraniKorisnik();
		exit();
	}

}


function AnalizirajUnos()
{
	if( !isset( $_POST['Guest'] ) || !isset( $_POST['Yacht'] ) )
	{
		crtaj_ulogiraniKorisnik( 'Trebate unijeti sve podatke.' );
		exit();
	}
	else
	{
		$user = 'student'; 
		$pass = 'pass.mysql';
		try 
		{
			$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Invoices (ID, Date, Operator, Guest, Yacht, StartDate, Duration) VALUES (2, '2018-07-07', 'Lubar',
			'Jessica Pearson, 'MilaYa', '2018-07-07', 7)"; 
		
			    // use exec() because no results are returned
			    $db->exec($sql); 
		} 
		catch( PDOException $e ) 
		{
			echo "Greška: " . $e->getMessage(); exit();
		} 
	}
}

?>
