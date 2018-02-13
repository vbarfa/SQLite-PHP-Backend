<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


$admin_user_id=  filter_input(INPUT_GET, 'id');
//Serve POST request.  
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // If non-super user accesses this script via url. Stop the exexution
    if($_SESSION['admin_type']!=='super_admin')
    {
        // show permission denied message
        echo 'Permission Denied';
        exit();
    }
    
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
	$user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
	
   	$updateQuery = "update accounts set user_name = '$user_name', password = '$password', type = '$type' where id = $id";
    $result = $db->query($updateQuery);
    
    if($result)
    {
        $_SESSION['success'] = "Admin user has been updated successfully";
    }
    else
    {
        $_SESSION['failure'] = "Failed to update Admin user";
    }

    header('location: users.php');
    
}


$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
//Select where clause


$selectQuery = "SELECT * FROM accounts where id = '$admin_user_id'";

$results = $db->query($selectQuery);

$accounts = $results->fetchArray(SQLITE3_ASSOC);


// Set values to $row

// import header
require_once 'includes/header.php';
?>
<div id="page-wrapper">

    <div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Update User</h2>
        </div>
        
    </div>
    
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <?php include_once './includes/forms/user_form.php'; ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>