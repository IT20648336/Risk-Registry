
<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Division</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/form.css" >
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  
   <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 15px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #F5F5F5;
  color: black;
}

.button {
  background-color: #9932CC
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.button2 {padding: 12px 28px;}
</style>

</head>
<Body>

<p><font size="4%" font color>Department Details</font></p>

<div class="center">
  <button id="show-submit">+Add New Division</button>
</div>


    <form method="post" align="center" enctype="multipart/form-data" id="AddDepartment" > 
  <?php echo csrf_field(); ?>
<div class="popup">
  <div class="close-btn">&times;</div>
  <div class="form">
  <h2>Add Department</h2> 
    <div class="form-element">
        <label for="Company_Name">Enter Division
        </label>
        <input type="text" id="Company_Name" name="Company_Name" placeholder="Enter Company">
    </div>
    
    <div class="form-element">
        <label for="Department_Name">Department Name</label>
        <input type="text" id="Department_Name" name="Department_Name" placeholder="Enter Department" required>
    </div>
    
    <div class="form-element">
        <label for="Contact_person">Contact Person Name</label>
        <input type="text" id="Contact_person" name="Contact_person" placeholder="Enter Contact Person Name" required>
    </div>
    
    <div class="form-element">
        <label for="Mobile_number">Mobile Number</label>
        <input type="text" id="Mobile" name="Mobile" placeholder="Enter Mobile Number" required>
    </div>
    
    <div class="form-element">
        <label for="Email">Enter Email</label>
        <input type="text" id="Email" name="Email" placeholder="Enter Email" required>
    </div>
    
    <div class="form-element">
      <input class="button" style="width: auto; height: 30px; padding: 3px 10px 10px; border-radius: 5px; font-size: 12px; text-align: center; background-color: #474747;" type="button" value="SAVE" onclick="AddNewDepartment('AddNewDepartment'); return false;" />
    </div>

</div>
</div>
</form>


<script>
  document.querySelector("#show-submit").addEventListener("click",function(){
      document.querySelector(".popup").classList.add("active");
  });
  
    document.querySelector(".popup .close-btn").addEventListener("click",function(){
      document.querySelector(".popup").classList.remove("active");
  });
  

</script>

<form method="post" align="center" enctype="multipart/form-data" id="EditDepartment" > 
  <?php echo csrf_field(); ?>
<table id="customers" style="margin-top:80px;">


  <tr>
  <th>Company Name</th>
    <th>Department Name</th>
    <th>Contact Person Name </th>
    <th>Mobile Number</th>
    <th>Email Address</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  
  <?php $__currentLoopData = $department1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
          <td><?php echo e($department['Company_Name']); ?></td>
          <td><?php echo e($department['Department_Name']); ?></td>
          <td><?php echo e($department['Contact_person']); ?></td>
          <td><?php echo e($department['Mobile']); ?></td>
          <td><?php echo e($department['Email']); ?></td>
          <td><?php if($department['status']): ?> <div style="text-align:center">&nbsp;<p style="color:green;" class="txt1">&#9679; <b>Active </b></p></span></div>
              <?php else: ?> <div style="text-align:center">&nbsp;<p style="color:red;" class="txt1">&#9679; <b>Rejected</b> </p></span></div> <?php endif; ?></td>
          </td>
          
          
          <td>
          <input data-id="<?php echo e($department->DID); ?>" id="toggle_btn" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" data-off="Disable" <?php echo e($department->status ? 'checked' : ''); ?> >
          <div class='btn-group'>


          

          
          
          <button type="submit" style="background-color:rgba(255,255,255,0.0); border:none;" id="resultButton" onclick="showResults();">
          <img src="/images/pencil.png" / style="width:auto;height:20px;" align="-80%" data-toggle="modal" data-target="#EditCompanyData" onclick="EditNewDepartment('EditNewDepartment?RowId=<?php echo e($department['id']); ?>'); return false;" id="button">&nbsp &nbsp Edit</button> 
<label class="switch">

           
           
           </div>
           </td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

</table>
</form>

<div id="EditDepartmentData" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:60%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="ContainerHeader" style="width:100%; background-color:#E5E5E5; color:#000000; border-radius: 0px">
UPDATE DEPARTMENT
<button type="button" class="close" data-dismiss="modal">×&nbsp;</button>
</div>
<div class="modal-body" align="center" style="width:100%;">
<form method="post" align="center" enctype="multipart/form-data" id="UpdateDepartmentData">
    <?php echo csrf_field(); ?>
                <table style="width: 95%;height: auto;margin: 0px auto; border: hidden;">  
                    <tr>
                       
                        <td style="border:hidden;text-align: left; width:14%;"><br>
                          <label for="Student"><b>COMPANY NAME</b></label><br>                      
                            <input type="text" id="EditCompanyName" name="EditCompanyName"  />                     
                        </td> 
                        <td style="border:hidden;text-align: left; width:14%;"><br>
                          <label for="Student"><b>DEPARTMENT NAME</b></label><br>                      
                            <input type="text" id="EditDepartmentName" name="EditDepartmentName"  />                     
                        </td> 
                        
                        <td style="border:hidden;text-align: left; width:14%;"><br>
                          <label for="Student"><b>CONTACT PERSON</b></label><br>                      
                            <input type="text" id="EditDepartmentContactPerson" name="EditDepartmentContactPerson" />                     
                        </td>
                        <td style="border:hidden;text-align: left; width:14%;"><br>
                          <label for="Student"><b>MOBILE</b></label><br>                      
                            <input type="text" id="EditDepartmentMobile" name="EditDepartmentMobile" />                     
                        </td>                        
                      </tr>
                      <tr>
                       <td style="border:hidden;text-align: left; width:14%;"><br>
                            <label for="Student"><b>EMAIL</b></label><br>
                            <input type="email" id="EditDepartmentEmail" name="EditDepartmentEmail" />
                        </td>
                      </tr>
                  </table>
        <br>
        <input class="button" style="width: auto; height: 25px; padding: 2px 10px 10px; border-radius: 5px; font-size: 12px; text-align: center; background-color: #00638B;" type="button" value="UPDATE" onclick="UpdateDepartment('UpdateDepartment'); return false;" />
<input type='hidden' name='EditRowId' id='EditRowId' />
</form>
</div>
</div>
 </div>
</div>

</Body>

<script>
var checkboxes = $("input[type='checkbox']"),
    submitButt = $("input[type='submit']");

checkboxes.click(function() {
    submitButt.attr("disabled", !checkboxes.is(":checked"));
});

var checkboxes = $("input[type='checkbox']"),
    submitButt = $("input[type='submit']");

checkboxes.click(function() {
    submitButt.attr("disabled", !checkboxes.is(":checked"));
});
$(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var user_id = $(this).data('id'); 
             console.log(user_id);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {'status': status, 'user_id': user_id},
                success: function(data){
                  console.log(data.success)
                  location.reload(); return false;
                }
            });
            
            
        })
      })
</script>


</Body>

</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('NavBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/Department/dvd.blade.php ENDPATH**/ ?>