
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/css/form.css" >
     <link rel="stylesheet" href="/css/UserTable.css" >
     
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
     </style>
      
    
  
  </head>
  
  <body>
  
  <p><font size="4%" ; color="#342D7E">User Details</font></p>
 
 <div class="center">
  <button id="show-submit">Edit User</button>
</div> 
 
  
 <form method="post" align="center" enctype="multipart/form-data" id="EditUser" class="form"> 
  <?php echo csrf_field(); ?>
  <table id="customers" style="margin-top:80px;">
  <tr>

    <th>User Id</th>
    <th>Date</th>
    <th>Time</th>
    <th>Name</th>
    <th>User Name</th>
    <th>User Email</th>
    <th>User Designation</th>
    <th>Status</th>
    <th>Last Updated</th>
    <th>Updated By</th>
    <th>Action</th>
  </tr>
  
   <tr>

    <td>01</td>
    <td>13-02-2023</td>
    <td>16:00:00</td>
    <td>Demo</td>
    <td>Demo_140265</td>
    <td>demo@gmail.com</td>
    <td>intern</td>
    <td>active</td>
    <td>13-02-2023</td>
    <td>Demo</td>
    <td><label class="switch">
                <input type="checkbox" checked>
                  <span class="slider round"></span>
                  
                  
              </label>
              <button type="submit" style="background-color:rgba(255,255,255,0.0); border:none;" id="resultButton" onclick="showResults();"><img src="/images/edit_icon.png" / style="width:auto;height:20px;" align="-80%" data-toggle="modal" data-target="#EditUser"  return false;" id="button"> </button> 
              
              
         
         
    
  </tr>
    <tr>

    <td>02</td>
    <td>13-02-2023</td>
    <td>15:00:00</td>
    <td>Demo</td>
    <td>Demo_140265</td>
    <td>demo@gmail.com</td>
    <td>intern</td>
    <td>active</td>
    <td>13-02-2023</td>
    <td>Demo</td>
    
      <td><label class="switch">
                <input type="checkbox" checked>
                  <span class="slider round"></span>
                  
                  
              </label>
              <button type="submit" style="background-color:rgba(255,255,255,0.0); border:none;" id="resultButton" onclick="showResults();"><img src="/images/edit_icon.png" / style="width:auto;height:20px;" align="-80%" data-toggle="modal" data-target="#EditUser"  return false;" id="button"> </button> 
    
  </tr>

  </table> 
  
<div class="popup">
  <div class="close-btn">&times;</div>
  <div class="form">
   <p align="left"><font size="4%";font color="black">Edit User</font></p><br>

<!-- UserName -->    
    <div class="form-element">
  <label for="Uname">Username</label><br>
  <input type="text" id="Uname" 
  name="Uname"><br>
  </div>
  
<!-- User Role -->    
  <p align="left">User Role</p>
  

  <div class="alignment">
          <input type="radio" id="ED" name="radio" value="Entity Admin"><label for="definitely"> Entity Admin</label>
       </div>
   
       <div class="alignment">
          <input type="radio" id="PA" name="radio" value="Portfolio Admin"><label for="maybe"> Portfolio Admin</label>
       </div>
           
       <div class="alignment"> 
          <input type="radio" id="PU" name="radio" value="Portfolio User"><label for="notsure"> Portfolio User</label>
       </div>
<style>
.multiselect {
 width:200px;
}
.selectBox {
 position:relative;
}
.selectBox select {
 width: 100%;
 font-weight: bold;
}
.overSelect {
 position: absolute;
 left:0; right:0; top:0; bottom:0;
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
</head>
<body>
<form>
 <div class="multiselect">
  <div class="selectBox" onclick="showCheckboxes()">
   <select>
    <option>Department</option>
   </select>
   <div class="overSelect"></div>
  </div>
  
  <div id="checkboxes">
   <label><input type="checkbox" id="1"/>Group Technology</label>
   <label><input type="checkbox" id="2"/>Group Management</label>
   <label><input type="checkbox" id="3"/>GIT</label>
  </div>
 </div>
 


<script>
var expanded = false;
function showCheckboxes()
{
 var checkboxes = document.getElementById("checkboxes");
 if(!expanded)
 {
  checkboxes.style.display = "block";
  expanded = true;
 }
 else
 {
  checkboxes.style.display = "none";
  expanded = false;
 }
}

</script>

<style>
.multiselect_1 {
 width:200px;
}
.selectBox_1 {
 position:relative;
}
.selectBox_1 select {
 width: 100%;
 font-weight: bold;
}
.overSelect_1 {
 position: absolute;
 left:0; right:0; top:0; bottom:0;
}
#checkboxes_1 {
 display: none;
 border: 1px #dadada solid;
}
#checkboxes_1 label {
 display: block;
}
#checkboxes_1 label:hover {
 background-color: #1e90ff;
}
</style>


  <div class="multiselect_1">
  <div class="selectBox_1" onclick="showCheckboxes_1()">
   <select>
    <option>Divisions</option>
   </select>
   <div class="overSelect_1"></div>
  </div>
  <div id="checkboxes_1">
   <label><input type="checkbox" id="4"/>VAS</label>
   <label><input type="checkbox" id="5"/>TX</label>
   <label><input type="checkbox" id="6"/>CORE</label>
  </div>
 </div>
</form>
</body>
<script>
var expanded = false;
function showCheckboxes_1()
{
 var checkboxes_1 = document.getElementById("checkboxes_1");
 if(!expanded)
 {
  checkboxes_1.style.display = "block";
  expanded = true;
 }
 else
 {
  checkboxes_1.style.display = "none";
  expanded = false;
 }
}

</script>
  
  
    <div class="form-element">
     <input class="button" style="width: 100px; height: 25px; padding: 3px 10px 10px;position : absolute;  bottom:2%; left:15%; border-radius: 5px;border-color: black;font-size: 12px; color: #342D7E;text-align: center; background-color:#FFFFFF;" type="close-btn" value="CANCEL"onclick="EditNewUser('EditNewUser'); return false;" />
     
      <input class="button" style="width: 100px; height: 25px; padding: 3px 10px 10px;position : absolute;  bottom:2%; right:15%; border-radius: 5px; font-size: 12px; text-align: center; background-color:#342D7E;" type="button" value="SAVE" onclick="EditNewUser('EditNewUser'); return false;" />
          
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


  
  
  </body>
  
  </html>
  
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('Nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/User/UserManage.blade.php ENDPATH**/ ?>