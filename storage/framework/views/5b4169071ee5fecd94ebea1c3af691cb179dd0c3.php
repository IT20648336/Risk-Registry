<!DOCTYPE html>
<html>
  <head>


 </head>
 
 <body>

    <!-- risk Dropdown -->
    <div> <!-- add opening div tag here -->
       <select id='sel_risk' name='Risk_Category'>
         <option value='0'>-- Select risk --</option>
        
         <div class="overSelect"></div>
      </div>
      
          <!-- Read Risks -->
             <?php $__currentLoopData = $risks['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $risk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <option type="checkbox" value='<?php echo e($risk->RiskCategory_ID); ?>'><?php echo e($risk->Risk_Category); ?></option>   
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div> 
           </select>
      
    </div> <!-- close the div tag -->
    <br><br>
    
    <!-- Subrisk Dropdown -->
    <div> <!-- add opening div tag here -->
       <select id='sel_emp' name='SubRisk_Category'>
          <option value='0'>-- SelectSub Risk --</option>
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

      
 </body>
       
 </html>```
<?php /**PATH /data/RiskRegistry/resources/views/RiskCreation/NewDropdown.blade.php ENDPATH**/ ?>