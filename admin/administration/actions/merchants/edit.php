
<?php
		$sql = 'SELECT * FROM accounts WHERE rank="merchant" and id="'.$_GET['id'].'"';
		$req = mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL');
		$data = mysql_fetch_array($req);
		
?>

<h1>Edition du compte de : <?php echo $data['civilite']." ".$data['nom']." ".$data['prenom'] ?></h1>
<form action="edit.php">
Civilit&eacute; : <SELECT name="civilite" size="1">

	<OPTION>	
					Mr
	
	<OPTION>	
					Mme
	
	<OPTION>	
					Mlle

</SELECT><br></br>

Nom de famille : <input type="textbox" name="nom" value="<?php echo $data['nom'] ?>"></input><br></br>
Prenom : <input type="textbox" name="prenom" value="<?php echo $data['prenom'] ?>"></input><br></br>
Email : <input type="textbox" name="mail" value="<?php echo $data['email'] ?>"></input><br></br>
T&eacute;lephone : <input type="textbox" name="nom" value="<?php echo $data['phonenumber'] ?>"></input><br></br>

<input type="submit"></input>
<input type="hidden" name="id" value="<?php echo $data['id'] ?>"></input><br></br>

</form>
<a href="index.php">Annulez</a>