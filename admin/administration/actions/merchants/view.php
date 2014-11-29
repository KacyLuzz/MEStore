	<?php 
	
	$sql = 'SELECT count(*) FROM accounts WHERE rank="merchant"';
	$req = mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL');
	$data = mysql_fetch_array($req);
	
	?>	
	
	<table style="color:olive;">
	
	<tr>
	
		<th>
		
		Nombres de marchants : <?php echo $data['0'] ?>
		
		</th>
	
	</tr>
	
	<tr>
	
		<th>
Civilit&eacute;
		</th>
	
		<th>
Nom
		</th>
	
		<th>
		Pr&eacute;nom
		</th>
		
		<th>
		SOUS LE PSEUDO
		</th>
	
		<th>
		Pseudo
		</th>
	
	</tr>
	
	<table style="color:green;">
<?php
		$sql = 'SELECT * FROM accounts WHERE rank="merchant"';
		$req = mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL');
		while($data = mysql_fetch_array($req)) {
			
		
		echo '<tr ><th style="color:red;"> '.$data['civilite'].'</th><th style="color:red;"> '.$data['nom'].' </th><th style="color:red;">'.$data['prenom'].' </th><th>sous le Pseudo :</th><th style="color:red;"> '.$data['username'].'</th></tr><tr><th><a href="index.php?action=edit&id='.$data['id'].'">Editez</a> | <a href="sup.php?id='.$data['id'].'">Supprimez</a></th></tr>';
			
		}
?>
</table>
	
	
	</table>