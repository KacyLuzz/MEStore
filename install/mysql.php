    <?php

   $fp = fopen ("../config.php", "a+");
   	
    
    fputs($fp,"<?php ");
    
    fputs($fp,'$mysql_host="'.$_POST['mysqlhost'].'"; ');
  
    fputs($fp,'$mysql_password="'.$_POST['mysqlpass'].'"; ');
    fputs($fp,'$mysql_username="'.$_POST['mysqluser'].'"; ');
    fputs($fp,'$mysql_db="'.$_POST['mysqldb'].'"; ');
	fputs($fp,'?>');
    fclose ($fp);

    header('Location: index.php?s=2');
    exit();
    
    ?>