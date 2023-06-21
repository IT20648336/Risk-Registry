
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html>
  <head>

    <link rel="stylesheet" href="/css/form.css">
    <link rel="stylesheet" href="/css/UserTable.css"> 
 

    
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
          <input type="radio" id="ED" name="radio" value="1"><label for="definitely">Entity Admin</label>
       </div>
   
       <div class="alignment">
          <input type="radio" id="PA" name="radio" value="2"><label for="maybe">Portfolio Admin</label>
       </div>
           
       <div class="alignment"> 
          <input type="radio" id="PU" name="radio" value="3"><label for="notsure">Portfolio User</label>
       </div>
       
<!-- DEPARTMENT DROPDOWN -->
    <div>
        <label for="department">Department Name:</label>
        <select id="Department_Id" name='Department_Id'>
            <option value="">Select a department</option>
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $departmentName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>"><?php echo e($departmentName); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


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

<!-- DEPARTMENT DIVISION DROPDOWN -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#Department_Id').on('change', function() {
                var departmentId = $(this).val();

                if(departmentId) {
                    $.ajax({
                        url: '/get-department/' + departmentId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#Department_Name').val(data.Department_Name);
                        }
                    });
                } else {
                    $('#Department_Name').val('');
                }
            });
        });
    </script>



    </body>
  </html> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/User/UserCreate.blade.php ENDPATH**/ ?>