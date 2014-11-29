<?php

include('../config.php');

$newmysql = mysql_connect($mysql_host,$mysql_username,$mysql_password);

mysql_select_db($mysql_db,$newmysql);

$sql = "UPDATE `accounts` SET password=\"".sha1($_POST['pass'])."\" WHERE username=\"admin\"";
mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL');

header('Location: index.php?s=5');
exit();

?>