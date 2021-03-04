<?php
ob_start();
require_once "vendor/autoload.php";
use \Models\Users;
use \Models\SessionManager;
$session = new SessionManager();
$users = new Users();
require_once('inc/functions.inc.php');
require_once('inc/config.inc.php');
if(!$users->isLoggedIn()){ transfers_to('./login.php'); }
?>
