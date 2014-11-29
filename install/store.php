    <?php

    include('../config.php');
    
    $newmysql = mysql_connect($mysql_host,$mysql_username,$mysql_password);

    mysql_select_db($mysql_db,$newmysql);
    
    $sql = "UPDATE `storeconfig` SET `storename`=\"".$_POST['name']."\",`storeowner`=\"".$_POST['owner']."\",`storeemail`=\"".$_POST['mail']."\" WHERE id=\"1\"";
    mysql_query($sql) or die('Erreur avec votre configuration , ou votre serveur MySQL');

    mail($_POST['mail'],"[MEStore] Configuration de votre magasin","Votre magasin a été configurée , au informations suivantes : 
    		
    		Nom   : ".$_POST['name']."
    		Owner : ".$_POST['owner']."
    		Email : Votre email
    	    
    		");
    
    
    header('Location: index.php?s=3');
    exit();
    
    ?>