<?php 

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
		
?>
<head>

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

<?php 

$sql = 'SELECT count(*) FROM products';
$req = mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL');
$data = mysql_fetch_array($req);

?>

<h3><center>Nous avons <?php echo $data['0'] ?> produits</center></h3>
<table style="color:green;">
<?php
		$sql = 'SELECT * FROM products';
		$req = mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL');
		while($data = mysql_fetch_array($req)) {
			
		echo '<tr><th><img src="'.$data['image'].'"></img></th><th>'.$data['description'].'</th></tr>';
		echo '<tr><th><a href="product.php?id='.$data['id'].'">'.$data['nom'].'                  </a> </th></tr>';
		echo '<tr><th>Prix : '.$data['prix'].' &euro;                                      </th><th>Stock : '.$data['stock'].'</th></tr>';
			
		}
?>
</table>

<div class="footer" style="position:absolute; bottom:0; background:black; left:0; width:1365; height:60;"></div>

<div id="down"></div>

</body>