<?php
		$sql = 'DELETE FROM accounts WHERE rank="merchant" and id="'.$_GET['id'].'"';
		$req = mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL '.mysql_error());
		$data = mysql_fetch_array($req);

		header('Location: ../');
		exit();
		
?>