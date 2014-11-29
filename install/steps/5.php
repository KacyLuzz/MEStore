
<?php

    include('../config.php');
    
    $newmysql = mysql_connect($mysql_host,$mysql_username,$mysql_password);

    mysql_select_db($mysql_db,$newmysql);
    
    $sql = "SELECT * FROM storeconfig";
    $req = mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL');
	$data = mysql_fetch_array($req);

    
    ?>

<center><h1>Configuration:</h1>
<h3>&Eacute;tape (5/5) : Bravo! </h3>
</center>
<form action="../admin/" method="post">

Rappel de votre configuration :<br></br>

Nom de boutique : <?php echo $data['storename'] ?><br></br>
Organisation : <?php echo $data['storeowner']?><br></br>
E-Mail : <?php echo $data['storeemail'] ?><br></br>

<input type="submit" value="C'est partie pour plus de configuration!!!"></input>

</form>
