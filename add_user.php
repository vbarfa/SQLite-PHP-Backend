<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Only super admin is allowed to access this page
if ($_SESSION['admin_type'] !== 'super_admin') {
    // show permission denied message
    echo 'Permission Denied';
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	//$data_to_store = filter_input_array(INPUT_POST);
    
    //Password should be md5 encrypted

	$user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
		
	$insertQuery = "insert into accounts(user_name, password, type) values('$user_name','$password','$type')";
    $result = $db->query($insertQuery);
	
    if($result)
    {
    	$_SESSION['success'] = "Admin user added successfully!";
    	header('location: users.php');
    	exit();
    }  
    
}

$edit = false;


require_once 'includes/header.php';
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">Add User</h2>
		</div>
	</div>
	<!-- Success message -->
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './includes/forms/user_form.php'; ?>
	</form>
</div>




<?php include_once 'includes/footer.php'; ?>