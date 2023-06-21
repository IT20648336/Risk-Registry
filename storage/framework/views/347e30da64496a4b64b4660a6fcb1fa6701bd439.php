
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/newcss.css">
      
<script>
    $(document).ready(function() {
        // Hide the tables and attachment by default
        $('#changes-table').hide();
        $('#shares-table').hide();
        $('#avoid-attachment').hide();

        // Show the selected table and attachment
        $('#action').on('change', function() {
            if ($(this).val() == 'change') {
                $('#changes-table').show();
                $('#shares-table').hide();
                $('#avoid-attachment').hide();
            } else if ($(this).val() == 'share') {
                $('#changes-table').hide();
                $('#shares-table').show();
                $('#avoid-attachment').hide();
            } else if ($(this).val() == 'Avoid') {
                $('#changes-table').hide();
                $('#shares-table').hide();
                $('#avoid-attachment').show();
            } else {
                $('#changes-table').hide();
                $('#shares-table').hide();
                $('#avoid-attachment').hide();
            }
        });
    });
</script>
</head>

<body>


<div class="ContainerRisk">
  <h3> Risk Treatment </h3>
   <form method="POST" action="/submit-form5?risk_id=<?php echo e($risk_id); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>

            <div class="form-group">
                <select id="action" name="action">
                    <option value="">--Select--</option>
                    <option value="Avoid">Avoid</option>
                    <option value="change">Change</option>
                    <option value="share">Share</option>
                    <option value="Retain">Retain</option>
                </select>
            </div>
            
            


      <!-- Editable table -->
      <!-- Change table   -->
<div id="changes-table">
      <div class="card">
        <div class="card-body">
          <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="Add_Risk_Treatment1">
            <button type="button" class="button4">Row&nbsp;&nbsp;<img id="Logout" src="/images/plus.png"/></button>
          </a>
          <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="Remove_Risk_Treatment1">
            <button type="button" class="button7">Row&nbsp;&nbsp;<img id="Logout" src="/images/minus.png"/></button>
          </a><br><br>
          <table class="Add_Risk_Treatment-List1" id="Risk_Treatment">
            <thead>
              <tr>
                <th class="text-center">Risk Response Activity</th>
                <th class="text-center">Action Owner</th>
                <th class="text-center">Action Due Date</th>
                <th class="text-center">Effectiveness of Risk Mitigation Method</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="pt-3-half"><input style="width:auto;" type="text" name="Risk_Res_Activity[]" id="Risk_Res_Activity[]" ></td>
                
                <td class="pt-3-half">
                  
                  <select name="Action_Owner[]" id="Action_Owner[]" style="width:auto;">
                    <option value='0'></option>
                    <!-- Read Owners -->
                       <?php $__currentLoopData = $owners['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option type="checkbox" value='<?php echo e($owner->User_Id); ?>'><?php echo e($owner->User_Name); ?></option>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </td>
            
            <td class="pt-3-half">
               <input type="date" id="Action_Date[]" name="Action_Date[]" placeholder="Select suitable date" style="width:auto;"/>
            </td>
            
            <td class="pt-3-half">
                <select name="Risk_Mitigation_Method[]" id="Risk_Mitigation_Method[]" style="width:auto;">      
                  <option></option>
                  <option value="Ineffective">Ineffective (<25%)</option>
                  <option value="FE">Fairly Effective (25%<50%)</option>
                  <option value="ME">Mostly Effective (50%<75%)</option>
                  <option value="Effective">Effective (>75%)</option>
                  <option value="NA">N/A</option>
                </select>           
            </td>
            

          
          </tr>
          
        </tbody>
      </table>

  </div>
</div>
</div>




      <!-- Share table   -->
<div id="shares-table">
      <div class="card">
        <div class="card-body">
          <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="Add_Risk_Treatment2">
            <button type="button" class="button4">Row&nbsp;&nbsp;<img id="Logout" src="/images/plus.png"/></button>
          </a>
          <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="Remove_Risk_Treatment2">
            <button type="button" class="button7">Row&nbsp;&nbsp;<img id="Logout" src="/images/minus.png"/></button>
          </a><br><br>
          <table class="Add_Risk_Treatment-List2" id="Risk_Treatment2">
            <thead>
              <tr>
                <th class="text-center">Risk Response Activity</th>
                <th class="text-center">Action Owner</th>
                <th class="text-center">Action Due Date</th>
                <th class="text-center">Effectiveness of Risk Mitigation Method</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="pt-3-half"><input style="width:auto;" type="text" name="Risk_Res_Activity[]" id="Risk_Res_Activity[]" ></td>
                
                <td class="pt-3-half">
                  
                  <select style="width: auto;" name="Action_Owner[]" id="Action_Owner[]">
                    <option value='0'></option>
                    <!-- Read Owners -->
                       <?php $__currentLoopData = $owners['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option type="checkbox" value='<?php echo e($owner->User_Id); ?>'><?php echo e($owner->User_Name); ?></option>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </td>
            
            <td class="pt-3-half">
               <input type="date" id="Action_Date[]" name="Action_Date[]" placeholder="Select suitable date" style="width:auto;"/>
            </td>
            
            <td class="pt-3-half">
                <select name="Risk_Mitigation_Method[]" id="Risk_Mitigation_Method[]" style="width:auto;">      
                  <option></option>
                  <option value="Ineffective">Ineffective (<25%)</option>
                  <option value="FE">Fairly Effective (25%<50%)</option>
                  <option value="ME">Mostly Effective (50%<75%)</option>
                  <option value="Effective">Effective (>75%)</option>
                  <option value="NA">N/A</option>
                </select>           
            </td>
            

          
          </tr>
          
        </tbody>
      </table>

  </div>
</div>
</div>

      <!-- Avoid Attachment -->
        <div id="avoid-attachment">
           <div class ="card">
               <div class="card-body">  
               
                  
                                
                                <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success">
                <strong><?php echo e($message); ?></strong>
            </div>
          <?php endif; ?>
          <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
          <?php endif; ?>
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>
                                
                                
                                <br><br>
                                  <textarea onfocus="if(this.value==this.defaultValue)this.value='';" 
                                        onblur="if(this.value=='')this.value=this.defaultValue;">Type Your Commment Here..
                                  </textarea>
                                  
                                  
                                  
                    </div>
              </div>
        </div>

<input type="submit" value="Next" name="submit" class="btnN"> 
 
</form> 


<!-- Change Table Script -->
  
<script>

jQuery(function (){
    var counter = 1;
    jQuery('a.Add_Risk_Treatment1').click(function(event){
        event.preventDefault();

             var newRow = jQuery(
    '<tr>' +
    '<td class="pt-3-half"><input style="width: auto;" name="Risk_Res_Activity[]" type="text" id="Risk_Res_Activity[]" required></td>' +
    '<td class="pt-3-half"><select style="width: auto;" id="Action_Owner[]" name="Action_Owner[]"><option value="0"  name="Action_Owner[]" id="Action_Owner[]"></option>' +
            <?php $__currentLoopData = $owners['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                '<option value="<?php echo e($owner->User_Id); ?>"><?php echo e($owner->User_Name); ?></option>' +
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            '</select></td>' +
    '<td class="pt-3-half"><input style="width: auto;" name="Action_Date[]" type="date" id="Action_Date[]" required></td>' +
    '<td class="pt-3-half"><select name="Risk_Mitigation_Method[]" id="Risk_Mitigation_Method[]" style="width: auto;"><option></option><option value="Ineffective">Ineffective (<25%)</option><option value="FE">Fairly Effective (25%<50%)</option><option value="ME">Mostly Effective (50%<75%)</option><option value="Effective">Effective (>75%)</option><option value="NA">N/A</option></select></td>'+
    
    '</tr>');
             
            counter++;
            
            if (counter > 50) 
            return;
        jQuery('table.Add_Risk_Treatment-List1').append(newRow);

    });
});

jQuery(function (){

    jQuery('a.Remove_Risk_Treatment1').click(function(event){
        event.preventDefault();
        
        var rowCount = $('#Risk_Treatment tbody tr').length;
        
        if(rowCount > 1) {
            $('#Risk_Treatment tr:last').remove();
        } else {
            alert('You cannot delete the last remaining row.');
        }
    });
});


<!-- Sharable Table Script -->
jQuery(function (){
    var counter = 1;
    jQuery('a.Add_Risk_Treatment2').click(function(event){
        event.preventDefault();

             var newRow = jQuery(
    '<tr>' +
    '<td class="pt-3-half"><input style="width: auto;" name="Risk_Res_Activity[]" type="text" id="Risk_Res_Activity[]" required></td>' +
    '<td class="pt-3-half"><select style="width: auto;" name="Action_Owner[]"><option value="0"  id="Action_Owner[]"></option>' +
            <?php $__currentLoopData = $owners['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                '<option value="<?php echo e($owner->User_Id); ?>"><?php echo e($owner->User_Name); ?></option>' +
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            '</select></td>' +
    '<td class="pt-3-half"><input style="width: auto;" name="Action_Date[]" type="date" id="Action_Date[]" required></td>' +
    '<td class="pt-3-half"><select name="Risk_Mitigation_Method[]" id="Risk_Mitigation_Method[]" style="width: auto;"><option></option><option value="Ineffective">Ineffective (<25%)</option><option value="FE">Fairly Effective (25%<50%)</option><option value="ME">Mostly Effective (50%<75%)</option><option value="Effective">Effective (>75%)</option><option value="NA">N/A</option></select></td>' +
    
    '</tr>');
             
            counter++;
            
            if (counter > 50) 
            return;
        jQuery('table.Add_Risk_Treatment-List2').append(newRow);

    });
});

jQuery(function (){

    jQuery('a.Remove_Risk_Treatment2').click(function(event){
        event.preventDefault();
        
        var rowCount = $('#Risk_Treatment2 tbody tr').length;
        
        if(rowCount > 1) {
            $('#Risk_Treatment2 tr:last').remove();
        } else {
            alert('You cannot delete the last remaining row.');
        }
    });
});

</script>
</div>
</div>
</body>
</html> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/RiskCreation/RiskTreatment.blade.php ENDPATH**/ ?>