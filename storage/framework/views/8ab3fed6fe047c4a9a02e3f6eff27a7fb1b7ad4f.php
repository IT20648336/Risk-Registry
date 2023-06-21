
<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <link rel="stylesheet" href="css/PortfolioSelection.css" >
  
  
    

</head>


<body>

 <p> Risk Creation <p>





<!--Portfolio Selection Container-->

<div class="ContainerPortfolio"> 

 <h3>Portfolio Selection</h3>
 
<form method="POST" action="/submit-form1 ">

     <?php echo csrf_field(); ?>


<!-- Department Dropdown -->
 
     <br><br> <select id='sel_depart' name='sel_depart'>
       <option value='0'>-Select-</option>
       
        <!-- Read Departments -->
        <?php $__currentLoopData = $departments['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option type="checkbox" value='<?php echo e($department->ID); ?>'><?php echo e($department->Department_Name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </select>

    <br><br>
    
<input type="submit" value="Next" name="submit" class="btnM"> 

 <!-- <button type="submit"  value="SUBMIT">Submit</button> -->
      
   <input type="reset" class="buttonC" value="Clear">
              </form>
        </div> 
 
  
  
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

                    });

                 });
                 
   

    
     </script>
     
      
    
</body>


</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/RiskCreation/PortfolioSelection.blade.php ENDPATH**/ ?>