<?php
session_start();
//error_reporting(0);

require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';

if (!(isset($sec_data))) {
	$sec_data['req_admin'] = 0;
	$sec_data['req_loggedin'] = 0;
	$sec_data['redirect_url'] = './index.php';	
}

if (logged_in() === true) {
  $session_user_id =  $_SESSION['user_id'];
  $user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email');
  if (user_active($user_data['username']) === false) {
    session_destroy();
    header('Location: index.php');
    exit();
  }
} else {
	if ($sec_data['req_loggedin'] == 1){
	    header('Location: ' . $sec_data['redirect_url']);
	}
}

$errors = array();
?>
