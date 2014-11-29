<?php

include_once('../config.php');

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
 *
*/

include_once ('../system/panier/functions.php');


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


// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connect']) && $_POST['connect'] == 'Connexion') {
if ((isset($_POST['login']) && !empty($_POST['login']))) {

	$connect = mysql_connect($mysql_host,$mysql_username,$mysql_password);
	mysql_select_db($mysql_db,$connect);
	
// on teste si une entrée de la base contient ce couple login / pass
$sql = 'SELECT count(*) FROM accounts WHERE username="'.$_POST['login'].'" and password="'.sha1($_POST['pass']).'" and rank="admin"';
$req = mysql_query($sql) or die('Error with Might Espace MySQL Servers , please test later ');
$data = mysql_fetch_array($req);

mysql_free_result($req);
mysql_close();

// si on obtient une réponse, alors l'utilisateur est un membre
if ($data[0] == 1) {
session_start();
$_SESSION['admin'] = $_POST['login'];
header('Location: administration/');
exit();
}
// si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
elseif ($data[0] == 0) {
$erreur = "Erreur : Mot de passe , login &eacute;rron&eacute;e ou vous n'&ecirc;tes pas Administrateur";
}
// sinon, alors la, il y a un gros problème :)
else {
$erreur = 'Enregistr&eacute;e 2 fois!';
}
}
else {
$erreur = 'Au moins un des champs est vide.';
}
}




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
				
					<a class="panier" style="cursor:url('../cursor2.png'), default;">
					
					<?php echo compterArticles() ?> Articles | <?php echo MontantGlobal() ?> &euro;
					
					<span>
					
					<p>Vous avez : <strong><?php echo compterArticles() ?></strong> articles</p>
					<p>Pour un total de : <strong><?php echo MontantGlobal() ?></strong> &euro;</p>
					</span>
					
					</a>
				
				</th>
			
				<th>
				
								
				
				</th>
			
			</tr>
		
		</tbody>
	
	</table>
	
	
</div>

<br></br>

<h1><center>Espace Administrateur</center></h1>

<center>
<h6><?php if(isset($erreur)) {
	
	
	echo $erreur;
	
}
?></h6>

<form name="loginform" id="loginform" action="../admin/" method="post">

		<label for="login">Identifiant<br />
		<input type="text" name="login" value="<?php if (isset($_POST['login'])) {echo htmlentities(trim($_POST['login']));} else {echo htmlentities(trim($_COOKIE['cnuser']));} ?>"><br />

		<label for="login">Mot de passe<br />
		<input type="password" name="pass"><br />
<input class="button" type="submit" name="connect" value="Connexion">
</form><br></br>
</center>

<div class="footer" style="position:absolute; bottom:0; background:black; left:0; width:1365; height:60;">
<table>

<tr><th><a href="../">Accueil</a></th><th><a href="../panier.php">Panier</a></th></tr>
<tr><th><a style="color:red;">Espace Administrateur</a></th></tr>
</table>
</div>

<div id="down"></div>


</body>