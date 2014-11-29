<?php
session_start();

include_once('config.php');

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

include_once ('system/panier/functions.php');


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

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);
   //On verifie que $p soit un float
   $p = floatval($p);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}

echo '<?xml version="1.0" encoding="utf-8"?>';?>

<head>
<title>Votre panier</title>


<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

<style type="text/css">
body{

font-family: 'Open Sans', sans-serif;
cursor:url('cursor.png'), default;

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
<body style="cursor:url('cursor.png'), default; height:620;">

<div id="up"></div>

<div class="menu" style="position:absolute; top:0; left:0; width:100%; background:black;">
	
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
				
					<a class="panier" style="cursor:url('cursor2.png'), default;">
					
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

<h1><center>Bienvenue sur notre magasin!</center></h1>


<form method="post" action="panier.php">
<table style="color:green;">
	<tr>
		<td colspan="4">Votre panier</td>
	</tr>
	<tr>
		<td>Libell&eacute;</td>
		<td>Quantit&eacute;</td>
		<td>Prix Unitaire</td>
		<td>Action</td>
	</tr>


	<?php
	if (creationPanier())
	{
	   $nbArticles=count($_SESSION['panier']['libelleProduit']);
	   if ($nbArticles <= 0)
	   echo "<tr><td>Votre panier est vide </ td></tr>";
	   else
	   {
	      for ($i=0 ;$i < $nbArticles ; $i++)
	      {
	         echo "<tr>";
	         echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
	         echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
	         echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
	         echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">XX</a></td>";
	         echo "</tr>";
	      }

	      echo "<tr><td colspan=\"2\"> </td>";
	      echo "<td colspan=\"2\">";
	      echo "Total : ".MontantGlobal();
	      echo "</td></tr>";

	      echo "<tr><td colspan=\"4\">";
	      echo "<input type=\"submit\" value=\"Rafraichir\"/>";
	      echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

	      echo "</td></tr>";
	   }
	}
	?>
</table>
</form>

<div class="footer" style="position:absolute; bottom:0; color:white; background:black; left:0; width:100%; height:60;"><table>
<tr><th><a href="index.php">Accueil</a></th><th><a style="color:red;">Panier</a></th></tr>
<tr><th><a href="admin/">Espace Administrateur</a></th></tr></table></div>

<div id="down"></div>

</body>

