<fieldset>
    <div class="form-group">
        <label for="f_name">First Name *</label>
          <input type="text" name="name" value="<?php echo $edit ? $customer['name'] : ''; ?>" placeholder="Name" class="form-control" required="required" id = "name" >
    </div> 

   
    <div class="form-group">
        <label>Gender * </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="male" <?php echo ($edit &&$customer['gender'] =='male') ? "checked": "" ; ?> required="required"/> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="female" <?php echo ($edit && $customer['gender'] =='female')? "checked": "" ; ?> required="required" id="female"/> Female
        </label>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
          <input name="address" value="<?php echo $edit ? $customer['address'] : ''; ?>" placeholder="Address" class="form-control" type="text" id="address">
    </div> 

      
    <div class="form-group">
        <label for="email">Email</label>
            <input  type="email" name="email" value="<?php echo $edit ? $customer['email'] : ''; ?>" placeholder="E-Mail Address" class="form-control" id="email">
    </div>


 

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>