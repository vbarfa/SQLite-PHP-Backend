<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');

if($_SESSION['admin_type']!='super_admin'){
    header('HTTP/1.1 401 Unauthorized', true, 401);
    exit("401 Unauthorized");
}


// Delete a user using user_id
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $deleteQuery = "delete from accounts where id = '$del_id'";
    $result = $db->query($deleteQuery);
    if ($result) {
        $_SESSION['info'] = "User deleted successfully!";
        header('location: users.php');
        exit;
    }
}