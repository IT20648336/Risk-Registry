<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 Add/Remove Multiple Input Fields Example</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .container {
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="<?php echo e(url('store-input-fields')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php if($errors->any()): ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>
            <?php if(Session::has('success')): ?>
            <div class="alert alert-success text-center">
                <p><?php echo e(Session::get('success')); ?></p>
            </div>
            <?php endif; ?>
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Risk Response Activity</th>
                    <th>Action Owner</th>
                    <th>Action Due Date</th>
                    <th>Effectiveness of risk mitigation method</th>
                    <th>Current Status</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>
                       <input type="text" name="risk[0][Risk_Activity]" placeholder="Enter risk" class="form-control" />
                    </td>
                    
                    <td>
                            <!-- Risk Owner -->
                             <br><br> 
                             <select id='sel_owner' name="sel_owner[1]">
                               <option value='0'></option>
                               
                                <!-- Read Departments -->
                                <?php $__currentLoopData = $owners['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option type="checkbox" value='<?php echo e($owner->User_Id); ?>'><?php echo e($owner->User_Name); ?></option>
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
                    </td>
                    
                    <td>
                          <input type="Date">
                    </td>
                    
                    <td>
                          <!-- START DROPDOWN --> 
                               <select name="Control_Effectiveness" id="CE">
                      
                                  <option></option>
                                  <option value="Ineffective">Ineffective (<25%)</option>
                                  <option value="FE">Fairly Effective (25%<50%)</option>
                                  <option value="ME">Mostly Effective (50%<75%)</option>
                                  <option value="Effective">Effective (>75%)</option>
                                  <option value="NA">N/A</option>
                              </select>
                    </td>
                    <td>
                            <!-- Risk Owner -->
                             <br><br> 
                             <select id='cs_status' name="cs_status[1]">
                               <option value='0'></option>
                               
                                <!-- Read Departments -->
                                <?php $__currentLoopData = $current_status['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $current_statu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option type="checkbox" value='<?php echo e($current_statu->id); ?>'><?php echo e($current_statu->Current_Status); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                              </select>
                    
                            <br><br>
                        
                            <!-- Script -->
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                              <script type='text/javascript'>
                              $(document).ready(function(){
                          
                                  // User Change
                                  $('#cs_status').change(function(){
                          
                                       // Department id
                                       var id = $(this).val();
                                       
                                       // Empty the dropdown
                                       $('#sel_emp').find('option').not(':first').remove();
                          
                                              });
                                           });
                             </script>
                    </td>
                    <td>
                       <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Subject</button>
                    </td>
                </tr>
            </table>
            
            <button type="submit" class="btn btn-outline-success btn-block">Save</button>
        </form>
    </div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="risk[' + i +
            '][Risk_Activity]" placeholder="Enter risk" class="form-control" /></td><td><input type="text" name="sel_owner[' + i +
            '][sel_owner]" placeholder="Enter risk" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>


</body>
</html><?php /**PATH /data/RiskRegistry/resources/views/RiskCreation/editNew.blade.php ENDPATH**/ ?>