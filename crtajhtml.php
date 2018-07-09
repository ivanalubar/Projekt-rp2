<?php 

function crtaj_header()
{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf8">
		<title>Projekt</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
	</head>
	<body style="background-color: 	white;">
	<?php
}


function crtaj_footer()
{
	?>
	</body>
	</html>	
	<?php
}


function crtaj_formaZaLogin( $errorMsg = '' )
{
	crtaj_header();
	?>
	</br></br></br>
	<form method="post" action="<?php echo htmlentities( $_SERVER["PHP_SELF"] ); ?>">
	
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style> 
body
{
    background: url('https://robbreportedit.files.wordpress.com/2017/03/sunseeker-95-yacht-01.jpg?w=1024') fixed;
    background-size: cover;
    padding: 0;
    margin: 0;
}

</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="wrap">
                <center><form class="login">
		<p class="form-title">
                    Sign In</p>
		<table>
			<tr>
				<th>Username</th>
				<th><input type="text" placeholder="Username"  name="Prezime"/></th>
			</tr>
			<tr>
				<th>Password</th>
				<th><input type="password" placeholder="Password" name="Lozinka" /></th>
			</tr>
			<tr>
				<th></th>
				<th><input type="submit" value="Sign In" class="btn btn-success btn-sm" /></th>
			</tr>
		</table>
                </form></center>
            </div>
        </div>
    </div>
    
</div>

	</form>


	<?php
	if( $errorMsg !== '' )
		echo '<p>Greška: ' . $errorMsg . '</p>';

	crtaj_footer();
}




function crtaj_ulogiraniKorisnik( $errorMsg = '' )
{
	$pomocna = $_SESSION['Prezime'];
	$_SESSION['Prezime'] = $pomocna;
	crtaj_header();
	?>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Turistic Agency</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="index.php">Home</a></li>
	      <li><a href="Popis_racuna.php">Review</a></li>
	      <li><a href="Statistika.php">Calendar</a></li>
	      <li><a href="Profit.php">Profit</a></li>	
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	      <li><a href="NewYacht.php"><span class="glyphicon glyphicon-plus"></span>Add new yacht</a></li>
	      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	    </ul>
	  </div>
	</nav>
<p style="float:left;"><span class="glyphicon glyphicon-user"></span>User: <?php echo $_SESSION['Prezime'];  $pomocna = $_SESSION['Prezime'];?> </p>
	
	<center><form id="formaZaUnos" method="post" action="<?php echo htmlentities( $_SERVER["PHP_SELF"] ); ?>">
	
	<table class="table">
		<thead class="thead-dark">
		    <tr>
		      <th scope="col">Invoice Number</th>
		      <th scope="col">Date</th>
		      <th scope="col">Operator name</th>
		      <th scope="col">Name of the guest</th>
		      <th scope="col">Name of the yacht</th>
		      <th scope="col">Period</th>
		      <th scope="col">The number of overnight stays </th>
		    </tr>
		  </thead>
		<tbody>
		    <tr>
		      <th>1</th>
		      <td><input type="text" value=<?php
			echo  date("Y-m-d") ;?>></input></td>
		      <td><input type="text" value =<?php echo $_SESSION['Prezime'];?>></input></td>
		      <td><input type="text" name="Guest"></input></td>
		      <td><select name="Yacht">
			<?php
				$user = 'student'; 
				$pass = 'pass.mysql'; 
				$pomocni = $_SESSION['Prezime'];
				try 
				{
					$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
				} 
				catch( PDOException $e ) 
				{
					echo "Greška: " . $e->getMessage(); exit();
				}
				$st3 = $db->query( 'SELECT Name FROM Yacht');
		
				foreach( $st3->fetchAll() as $row )
				{
					echo "<option style='width:100px;'>" . $row[ 'Name' ] . "</option>";
				}
			?>
			</select>
			</td>
		      <td><input type="text" name = "StartDate"></input></td>
		      <td><input type="text" name="Duration"></input></td>
		    </tr>
		    <tr>
		      <th></th>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td><button type="submit" >Add</button></td>
		    </tr>
		   
		  </tbody>
		</table>
	
	</form>	</center>
<?php 

if( isset( $_POST['Guest'] ) && isset( $_POST['Yacht'] ) && isset( $_POST['StartDate'] ) && isset( $_POST['Duration'] )  )
{	
	$op = $_SESSION['Prezime'];
	$datum = date("Y-m-d");
	$gost = $_POST['Guest'];
	$jahta = $_POST['Yacht'];
	$pocetak = $_POST['StartDate'];
	$trajanje =  $_POST['Duration'];

	$dd = date_parse_from_format("Y-m-d", $pocetak);
	$MM= $dd["month"];
	$DD= $dd["day"];
	if(($DD + $trajanje)> 31)
	{
		echo "You have to make 2 invoices for 2 months!";
	}
	else
	{
		$br=1;
		$user = 'student'; 
		$pass = 'pass.mysql';
		try 
		{
			$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$st3 = $db->query( 'SELECT * FROM Invoices');
			$st8 = $db->query( 'SELECT * FROM Invoices Where Yacht = "' . $jahta . '"');

			foreach( $st8->fetchAll() as $row )
			{
				$date = $row[ 'StartDate' ];
				$duration =  $row[ 'Duration' ];
				$d = date_parse_from_format("Y-m-d", $date);
				$M= $d["month"];
				$D= $d["day"];
				//echo $row[ 'StartDate' ];
				for($n=0;$n<$duration;$n++)
				{
					if($MM == $M)
					{
						if($DD >= $D and $DD <= ($D + $duration) and ($D + $trajanje)>=$D)
						{
							echo "That period is alredy booked!";
							return;
						}
					}
				}	

			}
			foreach( $st3->fetchAll() as $row )
			{	
				$br ++;
			}
			$sql = "INSERT INTO Invoices (ID, Datum, Korisnik, Guest, Yacht, StartDate, Duration) VALUES 
			(". $br . ",'". $datum ."', '". $op . "', '" . $gost ."', '". $jahta ."', '" . $pocetak ."', ". $trajanje ." );"; 
		
			    // use exec() because no results are returned
			    $db->exec($sql); 
		echo "Succesfully created new invoice!";
		} 
		catch( PDOException $e ) 
		{
			echo "Greška: " . $e->getMessage(); exit();
		} 
	}
	
	
}



?>

		<?php 
		$user = 'student'; 
		$pass = 'pass.mysql'; 
		$pomocni = $_SESSION['Prezime'];
		try 
		{
			$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
		} 
		catch( PDOException $e ) 
		{
			echo "Greška: " . $e->getMessage(); exit();
		}
		$user=$_SESSION['username'];
		$st3 = $db->prepare( 'SELECT * FROM Korisnik WHERE Prezime LIKE :Prezime' );
		$st3->execute( array( 'Prezime' => $Prezime ) );

		foreach( $st3->fetchAll() as $row )
		{

			$id = $row[ 'Stvaratelj_racuna	' ];
			
		}
		
		?>
		
		

	<?php
	crtaj_footer();
}

function Popis_racuna()
{
	?>
	<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Turistic Agency</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="index.php">Home</a></li>
	      <li><a href="Popis_racuna.php">Review</a></li>
	      <li><a href="Statistika.php">Calendar</a></li>
	      <li><a href="Profit.php">Profit</a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	      <li><a href="NewYacht.php"><span class="glyphicon glyphicon-plus"></span> Add new yacht</a></li>
	      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	    </ul>
	  </div>
	</nav>
<div class="container"><form method="post" action="<?php echo htmlentities( $_SERVER["PHP_SELF"] ); ?>">
  <h2>Filterable Table</h2>
  <p>Type something in the input field to search the table for bill number, yacht name or guest name:</p>  
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Bill number</th>
	<th>Date</th>
        <th>Operater</th>
        <th>Guest</th>
	<th>Yacht</th>
        <th>Start Date</th>
        <th>Duration</th>
	<th>Price per day + VAT</th>
	<th>Total Price</th>
	<th>13% VAT of included </th>
      </tr>
    </thead>
    <tbody id="myTable">
	<?php 
		$user = 'student'; 
		$pass = 'pass.mysql'; 
		$pomocni = $_SESSION['Prezime'];
		try 
		{
			$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
		} 
		catch( PDOException $e ) 
		{
			echo "Greška: " . $e->getMessage(); exit();
		}
		$user=$_SESSION['username'];
		$st3 = $db->query( 'SELECT * FROM Invoices');
		
		foreach( $st3->fetchAll() as $row )
		{
			echo "<tr>";
			echo "<td>" . $row[ 'ID' ] . "</td>";
			echo "<td>" . $row[ 'Datum' ] . "</td>";
			echo "<td>" . $row[ 'Korisnik' ] . "</td>";
			echo "<td>" . $row[ 'Guest' ] . "</td>";
			echo "<td>" . $row[ 'Yacht' ] . "</td>";
			echo "<td>" . $row[ 'StartDate' ] . "</td>";
			echo "<td>" . $row[ 'Duration' ] . "</td>";
			$st4 = $db->query( 'SELECT Price FROM Yacht where Name = "' . $row[ 'Yacht' ]  . ' "');
			foreach( $st4->fetchAll() as $roww )
			{
			echo "<td>" . ($roww[ 'Price' ]-($roww[ 'Price' ]/100*13) ). " € + ". ($roww[ 'Price' ]/100*13) ." € VAT</td>";
			$VAT = ($roww[ 'Price' ] *  $row[ 'Duration' ])/100*13;
			$neto = ($roww[ 'Price' ] *  $row[ 'Duration' ]) - $VAT;
			echo "<td><b>" . ($roww[ 'Price' ] *  $row[ 'Duration' ])  . " €</b></td>";
			echo "<td>" . $VAT . " €</td>";
			}
			echo "</tr>";
		}
		
	?>
     
    </tbody>
  </table>
  </form>
  
</div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>
</html>

	<?php
	
}


function Statistika()
{
	$pomocna = $_SESSION['Prezime'];
	$_SESSION['Prezime'] = $pomocna;
	crtaj_header();
	?>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Turistic Agency</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="index.php">Home</a></li>
	      <li><a href="Popis_racuna.php">Review</a></li>
	      <li><a href="Statistika.php">Calendar</a></li>
	      <li><a href="Profit.php">Profit</a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	      <li><a href="NewYacht.php"><span class="glyphicon glyphicon-plus"></span> Add new yacht</a></li>
	      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	    </ul>
	  </div>
	</nav>
	
	
	<center><form method="post" action="<?php echo htmlentities( $_SERVER["PHP_SELF"] ); ?>">
	Yacht: <select id="y" name = "y"> 
	<?php 
		$user = 'student'; 
		$pass = 'pass.mysql'; 
		$pomocni = $_SESSION['Prezime'];
		try 
		{
			$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
		} 
		catch( PDOException $e ) 
		{
			echo "Greška: " . $e->getMessage(); exit();
		}
		$user=$_SESSION['username'];
		$st3 = $db->query( 'SELECT * FROM Yacht');
		
		foreach( $st3->fetchAll() as $row )
		{

			echo "<option value='" . $row[ 'Name' ] . "'>" . $row[ 'Name' ] . "</option>";
			
		}
	?>
	</select><button id="btn" onclick="provjeri()" type="submit">Show</button>
	</br></br></br><p>Shedulle for the yacht <?php echo $_POST['y'] ;?></p>
	</center></form>
	<center>
	<table border=1; style=" height:200px;">
		<?php 
		for ( $i=6; $i<=9; $i++)
		{	
			echo "<tr>";
			for( $j=0;$j<=31; $j++)
			{
				if($i==6 && $j == 0)
				{
					echo "<th style='text-align:center;width:30px;'> June";
				}
				elseif($i==7 && $j == 0)
				{
					echo "<th style='text-align:center;width:30px;'> July";
				}
				elseif($i==8 && $j == 0)
				{
					echo "<th style='text-align:center;width:30px;'> August";
				}
				elseif($i==9 && $j == 0)
				{
					echo "<th style='text-align:center;width:30px;'> September";
				}
				else
				{
					echo "<th id='i".$i.$j."' style='text-align:center;width:30px;'>" . $j;
				}
			
			
			echo "</th>";
			}
		echo "</tr>";
		}
$user = 'student'; 
$pass = 'pass.mysql'; 
if( isset( $_POST['y'] ) )
{
	$brod = $_POST['y'] ;
}
else
{
	$brod = 'Milaya';
}
try 
{
	$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
} 
catch( PDOException $e ) 
{
	echo "Greška: " . $e->getMessage(); exit();
}

$st3 = $db->query( 'SELECT * FROM Invoices Where Yacht = "' . $brod . '"');

foreach( $st3->fetchAll() as $row )
{
	$date = $row[ 'StartDate' ];
	$duration =  $row[ 'Duration' ];
	$d = date_parse_from_format("Y-m-d", $date);
	$M= $d["month"];
	$D= $d["day"];
	//echo $row[ 'StartDate' ];
	for($n=0;$n<$duration;$n++)
	{
		echo "<style> #i".$M. ($D + $n)." { background-color: pink;}</style>";
	}	

}
	?>
	</table>

	<canvas id="mycanvas" style='width:70%;height:300px;background-color:gray;visibility:hidden;'></canvas></p>

<script>
$( document ).ready( function() {
	$( "#btn" ).on( "click", provjeri );
} );

function provjeri() {  				
	var e = document.getElementById("y");
	var jahta = e.options[e.selectedIndex].value;
	//alert("Izabrana jahta je " + jahta);
	
}
</script>
<?php
	crtaj_footer();
}


function Profit()
{
	$pomocna = $_SESSION['Prezime'];
	$_SESSION['Prezime'] = $pomocna;
	crtaj_header();
	?>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Turistic Agency</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="index.php">Home</a></li>
	      <li><a href="Popis_racuna.php">Review</a></li>
	      <li><a href="Statistika.php">Calendar</a></li>
	      <li><a href="Profit.php">Profit</a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	      <li><a href="NewYacht.php"><span class="glyphicon glyphicon-plus"></span> Add new yacht</a></li>
	      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	    </ul>
	  </div>
	</nav><center>
	<form method="post" action="<?php echo htmlentities( $_SERVER["PHP_SELF"] ); ?>">
	Yacht: <select id="z" name = "z"> 
	<?php 
		$user = 'student'; 
		$pass = 'pass.mysql'; 
		if( isset( $_POST['z'] ) )
		{
			$z = $_POST['z'] ;
		}
		else
		{
			$z = 'Milaya';
		}
		$pomocni = $_SESSION['Prezime'];
		try 
		{
			$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
		} 
		catch( PDOException $e ) 
		{
			echo "Greška: " . $e->getMessage(); exit();
		}
		$user=$_SESSION['username'];
		$st3 = $db->query( 'SELECT * FROM Yacht');
		
		foreach( $st3->fetchAll() as $row )
		{

			echo "<option value='" . $row[ 'Name' ] . "'>" . $row[ 'Name' ] . "</option>";
			
		}
	?>
	</select><button  type="submit">Show</button>
	</br></br></br><p>Profit for the yacht <?php echo $z ;?></p>
	</center></form>
	
	<center>
	<table border=1>
	<tr>
		<th style='width:150px;;text-align:center;'>Start Date</th>
		<th style='width:150px;;text-align:center;'>The price</th>
		<th style='width:150px;;text-align:center;'>VAT</th>
		<th style='width:150px;;text-align:center;'>Total price</th>
	</tr>
	<?php 
		$user = 'student'; 
		$pass = 'pass.mysql'; 
		$pomocni = $_SESSION['Prezime'];
		try 
		{
			$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
		} 
		catch( PDOException $e ) 
		{
			echo "Greška: " . $e->getMessage(); exit();
		}
		$user=$_SESSION['username'];
		$st3 = $db->query( 'SELECT Yacht.Name,Invoices.StartDate, Invoices.Duration, Yacht.Price FROM Yacht, Invoices where Yacht.Name = "'. $z . '" and Yacht.Name = Invoices.Yacht');
		$sum=0;
		foreach( $st3->fetchAll() as $row )
		{	
			echo "<tr>";
			echo "<th style='width:150px;;text-align:center;'>" . $row[ 'StartDate' ] . "</th>";
			$VAT = ($row[ 'Price' ]* $row[ 'Duration' ])/100*13;
			$total = $row[ 'Price' ]* $row[ 'Duration' ];
			$sum = $sum + (($row[ 'Price' ]* $row[ 'Duration' ])-$VAT);
			echo "<th style='width:150px;text-align:center;'>" . (($row[ 'Price' ]* $row[ 'Duration' ])-$VAT) . " € </th>";
			echo "<th style='width:150px;text-align:center;'>" . $VAT . " € </th>";
			echo "<th style='width:150px;text-align:center;'>" . $total . " € </th>";
			echo "</tr>";
		}
	
?>	</table></br><p>Total profit: <?php echo $sum; ?> €</p></center>
	<?php
	crtaj_footer();
}

function NewYacht()
{
	
	crtaj_header();
	?>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Turistic Agency</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="index.php">Home</a></li>
	      <li><a href="Popis_racuna.php">Review</a></li>
	      <li><a href="Statistika.php">Calendar</a></li>
	      <li><a href="Profit.php">Profit</a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	      <li><a href="NewYacht.php"><span class="glyphicon glyphicon-plus"></span> Add new yacht</a></li>
	      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	    </ul>
	  </div>
	</nav><center>
	<form method="post" action="<?php echo htmlentities( $_SERVER["PHP_SELF"] ); ?>">
	<h3>Fill the data below</h3>
	<table class="table">
		<thead class="thead-dark">
		    <tr>
		      <th scope="col">Yacht name</th>
		      <th scope="col">Length</th>
		      <th scope="col">Price per day</th>
		      <th scope="col"></th>
		    </tr>
		  </thead>
		<tbody>
		    <tr>
		      <td><input type="text" name="Ime"></input></td>
		      <td><input type="text" name="Duzina"></input></td>
		      <td><input type="text" name="Cijena"></input></td>
		      <td><button type="submit" >Add</button></td>
		    </tr>
		  </tbody>
		</table>
	
	</form>	</center>
<?php 

if( isset( $_POST['Ime'] ) && isset( $_POST['Duzina'] ) && isset( $_POST['Cijena'] ) )
{	
	$ime = $_POST['Ime'];
	$duzina = $_POST['Duzina'];
	$cijena = $_POST['Cijena'];
	$user = 'student'; 
	$pass = 'pass.mysql';
	$b=1;
	try 
	{
		$db = new PDO( 'mysql:host=rp2.studenti.math.hr;dbname=lubar;charset=utf8', $user, $pass );
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$st5 = $db->query( 'SELECT * FROM Yacht');

		foreach( $st5->fetchAll() as $row )
		{	
			$b ++;
		}
		$sql = "INSERT INTO Yacht ( ID, Name, Duljina, Price) VALUES (". $b .",'". $ime. "', ". $duzina .", ".$cijena .");"; 
		
		    // use exec() because no results are returned
		    $db->exec($sql); 
		echo "Succesfully added new yacht into database!";
	} 
	catch( PDOException $e ) 
	{
		echo "Greška: " . $e->getMessage(); exit();
	}
}
else
{
	echo "Fill the data.";
}	
	crtaj_footer();
}
?> 
