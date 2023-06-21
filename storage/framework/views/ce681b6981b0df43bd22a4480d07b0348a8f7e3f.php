
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html>
  <head>

    <link rel="stylesheet" href="/css/UserCreate.css">

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
       width: 41%;
       text-align: left;
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
        background-color: black;
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
  
  <body>
   
     <bold><p><font size="4%" ; color="black">User Details</font></p></bold>
 
       <div class="center">
          <button id="show-submit">+ Add User</button>
       </div> 
 
<form method="post" align="center" enctype="multipart/form-data" id="AddUser" class="form"> 

  <?php echo csrf_field(); ?>  
  
  <div class="popup">
       <div class="close-btn">&times;</div>
         <div class="form">
              <p align="left">
                <center>
                  <font size="4%";font color="black" style ="font-family:sans-serif; font-weight:bold;">Add User</font></p><br>
                </center>
            
            
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
<div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
        Department:
        <select id='sel_depart' name='sel_depart'>
            <option value='0'>-- Select department --</option>
            <?php $__currentLoopData = $departments['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value='<?php echo e($department->ID); ?>'><?php echo e($department->Department_Name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <div class="overSelect"></div>
    </div>

    <!-- Read Departments -->
    <div id="checkboxes">
        <?php $__currentLoopData = $departments['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <label>
                <input type="checkbox" name="department[]" value="<?php echo e($department->ID); ?>"> <?php echo e($department->Department_Name); ?>

            </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<br><br>

<!-- Departments Division Dropdown -->
Division:
<select id='sel_emp' name='sel_emp'>
    <option value='0'>-- Select Division --</option>
</select>


<button id="myButton">ADD</button>



<!-- Save Button -->
    <div class="form-element">
      <input class="button" style="width: 144px; height: 39px; padding: 8px 1px 10px; border-radius: 6px; font-size: 12px; text-align: center; background-color:#4A3B94; top: 165%; left:208px; position: absolute;" type="button" value="SAVE" onclick="AddNewUser('AddNewUser'); return false;" />


<table id="selected-items">
  <thead>
    <tr>
      <th>Department</th>
      <th>Division</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>


 </form>

        </div>
      </div>
    </div>
  </div>
  
   
 <script>
  document.querySelector("#show-submit").addEventListener("click",function(){
      document.querySelector(".popup").classList.add("active");
  });
  
    document.querySelector(".popup .close-btn").addEventListener("click",function(){
      document.querySelector(".popup").classList.remove("active");
  });

</script> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
    // Department Change
    $('#sel_depart, #checkboxes input[type=checkbox]').change(function(){
        // Department ids
        var ids = $('#checkboxes input[type=checkbox]:checked').map(function(){
            return $(this).val();
        }).get();

        // Empty the dropdown
        $('#sel_emp').find('option').not(':first').remove();

        // AJAX request 
        $.ajax({
            url: 'getDivisions/' + ids.join(','),
            type: 'get',
            dataType: 'json',
            success: function(response){
                console.log(response);
                var len = 0;
                if(response['data'] != null){
                    len = response['data'].length;
                }

                if(len > 0){
                    // Read data and create <option>
                    for(var i=0; i<len; i++){
                        var id = response['data'][i].Depart_ID; // Database ID
                        var name = response['data'][i].Division_Name;
                        var option = "<option value='"+id+"'>"+name+"</option>"; // Variable ID
                        $("#sel_emp").append(option); 
                    }
                }
            }
        });
    });
});

document.getElementById("myButton").addEventListener("click", function() {
  var selectedDepartments = [];
  var departmentCheckboxes = document.querySelectorAll('#checkboxes input[type=checkbox]:checked');
  
  // Get the names of the selected departments
  for (var i = 0; i < departmentCheckboxes.length; i++) {
    var departmentName = departmentCheckboxes[i].parentNode.textContent.trim();
    selectedDepartments.push(departmentName);
  }
  
  // Get the name of the selected division
  var selectedDivision = $("#sel_emp option:selected").text();

  // Display the selected department and division names
  alert("Selected department(s): " + selectedDepartments.join(", ") + "\nSelected division: " + selectedDivision);

  // Add the selected items to the table
  var tableBody = document.getElementById("selected-items").getElementsByTagName("tbody")[0];
  for (var i = 0; i < selectedDepartments.length; i++) {
    var newRow = tableBody.insertRow();
    var departmentCell = newRow.insertCell(0);
    departmentCell.innerHTML = selectedDepartments[i];
    var divisionCell = newRow.insertCell(1);
    divisionCell.innerHTML = selectedDivision;
  }
});
</script>



    </body>
  </html> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('NavBarN', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/User/UserNew.blade.php ENDPATH**/ ?>