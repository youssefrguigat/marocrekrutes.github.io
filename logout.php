<?php
require_once('session.php');
require_once('class.user.php');

$logout = new user();

if($logout->isloggedin()!="")
{
	$logout->redirect('home.php');
}
if(isset($_GET['logout']) && $_GET['logout'] == "true")
{
	$logout->logout();
	$logout->redirect('index.php');
}

?>