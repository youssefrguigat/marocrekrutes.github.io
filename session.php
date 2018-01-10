<?php

session_start();
require_once'class.user.php';
$session = new user();

if(!$session->isloggedin())
{
  $session->redirect('index.php');
}

?>