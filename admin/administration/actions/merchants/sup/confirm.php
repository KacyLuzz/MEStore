
<?php
		$sql = 'SELECT * FROM accounts WHERE rank="merchant" and id="'.$_GET['id'].'"';
		$req = mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL');
		$data = mysql_fetch_array($req);
		
?>

<h1>&Ecirc;tes vous s&ucirc;r de vouloir supprimez le compte MARCHAND de <?php echo "".$data['civilite']." ".$data['nom']." ".$data['prenom']." " ?></h1>
<a href="sup.php?subaction=del&id=<?php echo $_GET['id'] ?>">Confirmation</a> <a href="index.php">Annulez</a>