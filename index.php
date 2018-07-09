<?php 

require_once 'crtajhtml.php';
require_once 'analizirajPOST.php';
//require_once 'db.class.php';
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
session_start();

// Ako je korisnik već ulogiran, iscrtaj mu odgovarajuću stranicu, a ne formu za login.
if( isset( $_SESSION['Prezime'] ) )
{
	crtaj_ulogiraniKorisnik();
	exit();
}

// Provjeri da li se šalju podaci iz forme.
if( isset( $_POST['Prezime'] ) )
{
	analiziraj_POST_login();
	exit();
}
else
{
	crtaj_formaZaLogin();
	exit();
}


?> 
