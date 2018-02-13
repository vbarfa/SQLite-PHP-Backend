<?php
session_start();


//echo $middle = strtotime("2017-12-13 03:53:01");

require_once 'config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING);
$page = filter_input(INPUT_GET, 'page',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
	$DeletedDate = filter_input(INPUT_POST, 'DeletedDate', FILTER_SANITIZE_STRING);
	$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

    //Get input data
    //$data_to_update = filter_input_array(INPUT_POST);
    
    //$data_to_update['updated_at'] = date('Y-m-d H:i:s');
    
   /* $db->where('id',$customer_id);*/
    //$stat = $db->update('customers', $data_to_update);
	$deletedDate = strtotime($DeletedDate);
	$updateQuery = "update TransOrder set DeletedDate = '$deletedDate' where idTransOrder = $id";
	
	$result = $db->query($updateQuery);

    if($result)
    {
        $_SESSION['success'] = "Record updated successfully!";
        //Redirect to the listing page,
       if($page == 1){
	    header('location: reports.php');
	   } else {
	   	header('location: in_reports.php');
	   }	
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
	$selectQuery = "SELECT * FROM TransOrder where idTransOrder = $id";
	$result = $db->query($selectQuery);
	$record = $result->fetchArray(SQLITE3_ASSOC);
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <h2 class="page-header">Update Record</h2>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="contact_form">
        
      <fieldset>
    <div class="form-group">
        <label for="f_name">Item :-</label> <?php echo $edit ? $record['ItemID'] : ''; ?>
         
    </div> 

    <div class="form-group">
        <label for="address">Quantity :- </label> <?php echo $edit ? $record['Quantity'] : ''; ?>
    </div> 
    
     <div class="form-group">
        <label for="address">TransPrice :- </label> <?php echo $edit ? $record['TransPrice'] : ''; ?>
    </div> 

    <div class="form-group">
        <label>Deleted Date </label>
        <input type="text" id="DeletedDate" name="DeletedDate" class="form-control form-control1 selectpicker" required  value="<?php if( $record['DeletedDate']!=""){echo $edit ? date('Y-m-d H:i:s', $record['DeletedDate']) : ''; }?>"/>
          
    </div>  
   

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
    </form>
</div>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#DeletedDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>


<?php include_once 'includes/footer.php'; ?>