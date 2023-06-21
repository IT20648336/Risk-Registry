
<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="stylesheet" href="css/Main.css" >
  <link rel="stylesheet" href="css/form.css" >
  
  
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
  background-color: #DC143C;
  color: white;
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






<div class="center">
  <button id="show-submit">+Add New Company</button>
</div>
<form method="post" align="center" enctype="multipart/form-data" id="AddCompany" > 
  <?php echo csrf_field(); ?>
<div class="popup">
  <div class="close-btn">&times;</div>
  <div class="form">
  <h2>Add Company</h2> 
    <div class="form-element">
        <label for="brc">Enter BRC</label>
        <input type="text" id="brc" name="brc" placeholder="Enter BRC">
    </div>
    
    <div class="form-element">
        <label for="name">Company Name</label>
        <input type="text" id="name" name="name" placeholder="Enter Name">
    </div>
    
    <div class="form-element">
        <label for="contact_person">Contact Person Name</label>
        <input type="text" id="contact_person" name="contact_person" placeholder="Enter Contact Person Name">
    </div>
    
    <div class="form-element">
        <label for="mobile_number">Mobile Number</label>
        <input type="text" id="mobile" name="mobile" placeholder="Enter Mobile Number">
    </div>
    
    <div class="form-element">
        <label for="mobile_number">Enter Email</label>
        <input type="text" id="email" name="email" placeholder="Enter Email">
    </div>
    
    <div class="form-element">
      <input class="button" style="width: auto; height: 30px; padding: 3px 10px 10px; border-radius: 5px; font-size: 12px; text-align: center; background-color: #474747;" type="button" value="SAVE" onclick="AddNewCompany('AddNewCompany'); return false;" />
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






<table id="customers" style="margin-top:80px;">
  <tr>
     <th>ID</th>
    <th>Company Name</th>
    <th>Contact Person Name </th>
    <th>Mobile Number</th>
    <th>Email Address</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  

      <?php $__currentLoopData = $company1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
           <td><?php echo e($company['id']); ?></td>
          <td><?php echo e($company['name']); ?></td>
          <td><?php echo e($company['contact_person']); ?></td>
          <td><?php echo e($company['mobile']); ?></td>
          <td><?php echo e($company['email']); ?></td>
          <td><?php echo e($company['status']); ?></td>
          <td>
         
          
          <button type ="button" class="btn btn-success">Edit </button>           
         
         </td>
          
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
  
</table>


</Body>

</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('NavBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/Company.blade.php ENDPATH**/ ?>