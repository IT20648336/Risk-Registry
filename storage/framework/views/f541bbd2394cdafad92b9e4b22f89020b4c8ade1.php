
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html>
  <head>

    <link rel="stylesheet" href="/css/form.css">
     <link rel="stylesheet" href="/css/UserTable.css"> 
     
     <style>
     .alignment{
       display:flex;
       flex-direction:row;
     }
     
     .alignment input{
     margin-top: 2px;
     width:5%;
     }
     
     .alignment label{
     width: 100%;
     padding:10px;
     color: black;
     }
     
.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
     
     </style>
<script>
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>     
  </head>
  
  <body>
 
   <table id="customers" style="margin-top:80px; width: 80%;">
  <tr>

    <th>User Id</th>
    <th>Date</th>
    <th>Time</th>
    <th>Name</th>
    <th>User Name</th>
    <th>User Email</th>
  </tr>
  
   <tr>

    <td>01</td>
    <td>13-02-2023</td>
    <td>16:00:00</td>
    <td>Demo</td>
    <td>Demo_140265</td>
    <td>demo@gmail.com</td>         
    
  </tr>
  
  <tr>

    <td>02</td>
    <td>13-02-2023</td>
    <td>15:00:00</td>
    <td>Demo</td>
    <td>Demo_140265</td>
    <td>demo@gmail.com</td>
    
  </tr>

  </table>
  
   
     <p><font size="4%" ; color="#342D7E">User Details</font></p>

<!-- POPUP FORM -->  
       <div class="center">
          <button id="show-submit">+ Add User</button>
       </div>
        
<!-- START FORM --> 
<form method="post" align="center" enctype="multipart/form-data" id="AddUser" class="form"> 
  <?php echo csrf_field(); ?>  
  <div class="popup">
       <div class="close-btn">&times;</div>
         <div class="form">
            <p align="left"><font size="4%";font color="black">Add User</font></p><br>

<!-- UserName -->   
  <div class="form-element">
       <label for="Uname">Username</label><br>
         <input type="text" id="Uname" name="Name"><br>
  </div>
  

<!-- User Role -->  
        <div class="alignment">
          <input type="radio" id="ED" name="radio" value="Entity Admin"><label for="definitely"> Entity Admin</label>
       </div>
   
       <div class="alignment">
          <input type="radio" id="PA" name="radio" value="Portfolio Admin"><label for="maybe"> Portfolio Admin</label>
       </div>
           
       <div class="alignment"> 
          <input type="radio" id="PU" name="radio" value="Portfolio User"><label for="notsure"> Portfolio User</label>
       </div>
 <div class="multiselect"> 
 <div class="selectBox" onclick="showCheckboxes()">
<!-- Department Dropdown -->
     Department : <select id='sel_depart' name='sel_depart'>
       <option value='0'>-- Select department --</option>
       </select>
       <div class="overSelect"></div>
    </div>
        <!-- Read Departments -->
        <div id="checkboxes" style="background-color: #FFFFFF;">
        <?php $__currentLoopData = $departments['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <label style="color:#000000; background-color: #FFFFFF;"><input type="checkbox" id="<?php echo e($department->Id); ?>[]" name="<?php echo e($department->Id); ?>[]" />&nbsp;<?php echo e($department->Department_Name); ?></label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </div> 
    
 </div>
    <br><br>
    
<!-- Department Division Dropdown -->
    Division : <select id='sel_emp' name='sel_emp'>
        <option value='0'>-- Select Division --</option>
    </select>

<!-- Save Button --> 
    <div class="form-element">
      <input class="button" style="width: 50px; height: 30px; padding: 3px 10px 10px; border-radius: 5px; font-size: 12px; text-align: center; background-color:#4A3B94; top: 90%; position: absolute;" type="button" value="SAVE" onclick="AddNewUser('AddNewUser'); return false;" />
    
        </div>       
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

<!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type='text/javascript'>
    $(document).ready(function(){

        // Department Change
        $('#sel_depart').change(function(){

             // Department id
             var id = $(this).val();
             
             // Empty the dropdown
             $('#sel_emp').find('option').not(':first').remove();

             // AJAX request 
             $.ajax({
                 url: 'getDivisions/'+id,
                 type: 'get',
                 dataType: 'json',
                 success: function(response){
                  console.log(response);
                     var len = 0;
                     if(response['data'] != null){
                          len = response['data'].length;
                     }

                     if(len > 0){
                          // Read data and create <option >
                          for(var i=0; i<len; i++){

                               var id = response['data'][i].ID; //Database ID
                               var name = response['data'][i].Division_Name;

                               var option = "<option value='"+id+"'>"+name+"</option>"; //Variable ID

                               $("#sel_emp").append(option); 
                          }
                     }

                 }
             });
        });
    });
              
      </script>
    </body>
  </html> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/User/UserManageN.blade.php ENDPATH**/ ?>