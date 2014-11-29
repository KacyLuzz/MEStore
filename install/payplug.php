<?php
require_once("../system/payplug-payplug_php-f0a185c99905/lib/Payplug.php");
$isTest = false;
$parameters = Payplug::loadParameters($_POST['payplug_id'], $_POST['playplug_pass'], $isTest);
$parameters->saveInFile("../system/payplug-payplug_php-f0a185c99905/parameters.json");
?>