<?php
require_once "vendor/autoload.php";
use \Models\SessionManager;
use \Models\Users;
require_once('inc/functions.inc.php');
$session = new SessionManager();
$users = new Users();
$users->logout();
transfers_to('./login.html');
exit;

?>
