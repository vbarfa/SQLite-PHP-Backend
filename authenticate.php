<?php 
session_start();
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    
	
	$username = filter_input(INPUT_POST, 'username');
    $passwd = filter_input(INPUT_POST, 'passwd');
    $remember = filter_input(INPUT_POST, 'remember');
   /* $passwd=  md5($passwd);*/
   	
    $result = $db->query("SELECT type FROM accounts where user_name = '$username' and password = '$passwd'");
	$row = $result->fetchArray();
	$accountType = $row['type'];

	
    if ($accountType != "") {
        $_SESSION['user_logged_in'] = TRUE;
        $_SESSION['admin_type'] = $accountType;
       	if($remember)
       	{
       		setcookie('username',$username , time() + (86400 * 90), "/");
       		setcookie('password',$passwd , time() + (86400 * 90), "/");
       	}
        header('Location:index.php');
        exit;
    } else {
        $_SESSION['login_failure'] = "Invalid user name or password";
        header('Location:login.php');
        exit;
    }
  
}