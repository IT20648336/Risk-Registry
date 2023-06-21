
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<style>

txt1{
    position: right;
    left: 50px;
    right: 60px;
    top: 60px;
    bottom: 80.86%;
}
</style>
</head>
<Body>

<h3>Division Details</h3>

<div class="center">
  <button id="show-submit">+Add New Division</button>
</div>


<form method="post" align="center" enctype="multipart/form-data" id="AddDivision" class="form" action="<?php echo e(route('divisions.store')); ?>">
  <?php echo csrf_field(); ?>
<div class="popup">
  <div class="close-btn">&times;</div>
  <div class="form">
  <h2>Add Division</h2> 
  
<!-- *********************************  -->

    <div>
        <label for="department">Department Name:</label>
        <select id="Department_Id" name='Department_Id'>
            <option value="">Select a department</option>
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $departmentName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>"><?php echo e($departmentName); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <br>

        <input type="hidden" id="Department_Name" name="Department_Name" >

    
    
<!-- ********************************* -->
     
    <div class="form-element">
        <label for="Division_Name">Division Name</label>
        <input type="text" id="Division_Name" name="Division_Name" placeholder="Enter Division" required>
    </div>
    
    <div class="form-element">
        <label for="Contact_Person">Contact Person Name</label>
        <input type="text" id="Contact_Person" name="Contact_Person" placeholder="Enter Contact Person Name" required>
    </div>
    
    <div class="form-element">
        <label for="mobile_number">Mobile Number</label>
        <input type="text" id="Mobile" name="Mobile" placeholder="Enter Mobile Number" required>
    </div>
    
    <div class="form-element">
        <label for="Email">Enter Email</label>
        <input type="text" id="Email" name="Email" placeholder="Enter Email" required>
    </div>
    
    <div class="form-element">
      <input class="button" style="width: auto; height: 30px; padding: 3px 10px 10px; border-radius: 5px; font-size: 12px; text-align: center; background-color:#4A3B94;" type="button" value="SAVE" onclick="AddNewDivision('AddNewDivision'); return false;" />
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




</div>
 </div>
</div>

</Body>

</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('NavBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/pages/division.blade.php ENDPATH**/ ?>