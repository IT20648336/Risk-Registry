
<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="stylesheet" href="css/RiskIdentification.css" >
    
 

  
</head>

<body>

<p> Risk Creation <p>




<!--Risk Identification Container-->

<div class="ContainerRisk"> 

 <h4>Risk Identification</h4>
 

<form method="POST" action="/submit-form2?risk_id=<?php echo e($risk_id); ?>" >


     <?php echo csrf_field(); ?>
  
      <input type="hidden" name="risk_id" value="<?php echo e($risk_id); ?>">
      <div class="txt1">
           <label for="Risk_Topic">Risk Topic</label>
          <input type="text" id="exc" name="Risk_Topic">
      </div>
      <div class="txt2">
           <label for="Risk_Description">Risk Description</label><br><br>
           <textarea id="RD" name="Risk_Description" rows="4" cols="70"> </textarea>
      </div>
      <div class="txt3">
           <label for="High_Level_BO">High Level Business Objective</label>
          <input type="text" id="BO" name="HighLevel_BO">
      </div>
         
      <div class="txt4">
        <label for="RC">Risk Category</label>
      </div>
      
     
    <!-- risk Dropdown -->
    <div> <!-- add opening div tag here -->
       <select id='sel_risk' name='Risk_Category'>
         <option value='0'>-- Select Risk --</option>
        
         <div class="overSelect"></div>
      </div>
      
          <!-- Read Risks -->
             <?php $__currentLoopData = $risks['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $risk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <option type="checkbox" value='<?php echo e($risk->Risk_Category); ?>'><?php echo e($risk->Risk_Category); ?></option>   
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div> 
           </select>
      
    </div> <!-- close the div tag -->
    <br><br>
    
      
        <div class="txt5">
              <label for="RC">Sub Risk Category</label>
        </div>
    
    <!-- Subrisk Dropdown -->
    <div> <!-- add opening div tag here -->
       <select id='sel_emp' name='SubRisk_Category'>
          <option value='SubRisk_Category'>-- Select Sub Risk Category --</option>
      </select>
    </div> <!-- close the div tag -->
    
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type='text/javascript'>
      $(document).ready(function(){
        $('#sel_risk').change(function(){
          // risk id
          var id = $(this).val();
          // Empty the dropdown
          $('#sel_emp').find('option').not(':first').remove();
          // AJAX request
          $.ajax({
            url: 'getCategory/'+id,
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
                  var id = response['data'][i].RiskCategory_ID; //Database ID
                  var name = response['data'][i].Sub_Category;
                  var option = "<option value='"+id+"'>"+name+"</option>"; //Variable ID
                  $("#sel_emp").append(option);
                }
              }
            }
          });
        });
      });
    </script>

       
       

      
       
        
        <div class="txt6">
              <label for="RC">Risk Owner</label>
        </div>

        <!-- Risk Owner -->
         <br><br> 
         <select id='sel_owner' name='sel_owner'>
           <option value='0'></option>
           
            <!-- Read Departments -->
            <?php $__currentLoopData = $owners['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option type="checkbox" value='<?php echo e($owner->User_Name); ?>'><?php echo e($owner->User_Name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
          </select>

        <br><br>
    
        <!-- Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
          <script type='text/javascript'>
          $(document).ready(function(){
      
              // User Change
              $('#sel_owner').change(function(){
      
                   // Department id
                   var id = $(this).val();
                   
                   // Empty the dropdown
                   $('#sel_emp').find('option').not(':first').remove();
      
                          });
                       });
         </script> 
         
        
     <div class="txt7">
        <label for="RI">Risk Division</label>
     </div>
     
     
    <!-- Divisions -->
     <br><br> 
     
     <select id='sel_division' name='sel_division'>
       <option value='0'></option>
       
       <!-- Read Departments -->
       <?php $__currentLoopData = $divisions['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <option type="checkbox" value='<?php echo e($division->Division_Name); ?>'><?php echo e($division->Division_Name); ?></option>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       */
     </select>

    <br><br>
    
<!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type='text/javascript'>
    $(document).ready(function(){

        // User Change
        $('#sel_division').change(function(){

             // Department id
             var id = $(this).val();
             
             // Empty the dropdown
             $('#sel_emp').find('option').not(':first').remove();
                    });
                 });
     </script>  
    

      

<input type="submit" value="Next" name="submit" class="btnM"> 
   
    <INPUT TYPE="button" VALUE="Back" class="previous" onClick="history.go(-1);">
    <input type="reset" class="buttonC" value="Clear"> 
</form>    

</body>


</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/RiskCreation/RiskIdentification.blade.php ENDPATH**/ ?>