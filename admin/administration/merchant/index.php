<?php 

session_start();
if (!isset($_SESSION['admin'])) {
	header ('Location: ../../?notlogined');
	exit();
}

?>

<?php

include_once('../../../config.php');

/*
 *
 * FR_fr
 *
 * Pour copiez ce code source , vous avez besoin de l'autorisation de
 * Might Espace Inc. , demandez la par email a : contact@mightespace.url.ph
 *
*/

/*
 *
 * Including APIs
 * JSONParameters:json{disabled}
 *
*/




/*
 *
 * Connect MySQL
 *
*/

$connect = mysql_connect($mysql_host,$mysql_username,$mysql_password);
mysql_select_db($mysql_db,$connect);

/*
 *
 * Vars Definitions
 *
*/

$sql = 'SELECT * FROM storeconfig';
$req = mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL');
$data = mysql_fetch_array($req);

$locale = $data['storelocale'];
$language = $data['storelang'];
$name = $data['storename'];
$company = $data['storeowner'];
$email = $data['storeemail'];
$use = $data['mestoreuse'];

?>

<head>
<title><?php echo $name ?> - Espace Administrateur</title>

<style type="text/css">
body{

font-family: 'Open Sans', sans-serif;
cursor:url('../cursor.png'), default;

}

 a.panier:hover {
      background: none;
      z-index: 50;
   }
   
   a.panier span {
     display: none;
   }
   
   a.panier:hover span {
      display: block;
      position: absolute;
      top: 40px;
      left: -120px;

      background:blue;
      
      width:200px;

	}

table{

color:white;

}
</style>


</head>
<body style="cursor:url('../cursor.png'), default; height:620;">

<div id="up"></div>

<div class="menu" style="position:absolute; top:0; left:0; width:1366; background:black;">
	
	<table>
	
		<tbody>
		
			<tr>
			
				<th>
				
					<?php echo $name; ?>
				
				</th>
			
				<th>
				
								
				
				</th>
			
			</tr>
		
		</tbody>
	
	</table>

	<table style="position:absolute; right:40; top:0; color:orange;">
	
		<tbody>
		
			<tr>
			
				<th>

				
				</th>
			
				<th>
				
								
				
				</th>
			
			</tr>
		
		</tbody>
	
	</table>
	
	
</div>

<br></br>

<h1><center>Espace Administrateur</center></h1>

<?php 

if(!isset($_GET['action'])) {
	
	include('../actions/merchants/view.php');
	
} else if ($_GET['action']=="new") {
	
	include('../actions/merchants/new.php');
} else if ($_GET['action']=="edit") {
	
	include('../actions/merchants/edit.php');	
} else {
	
	include('../actions/defaults/errors.php?error=m1');
}


?>



<div class="footer" style="position:absolute; bottom:0; background:black; left:0; width:1365; height:60;">
<table>

<tr><th><a href="../">Accueil</a></th><th><a href="../panier.php">Panier</a></th></tr>
<tr><th><a style="color:green;">Espace Administrateur</a></th><th><a href="../">Statistiques</a></th><th><a style="color:red;">Marchands</a></th></tr>
</table>
</div>

<div id="down"></div>


</body>