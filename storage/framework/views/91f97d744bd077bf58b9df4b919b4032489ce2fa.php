<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <form>
        <?php echo csrf_field(); ?>
        <select id="dropdown" name="dropdown">
            <option value="">Select an option</option>
            <option value="avoid">Avoid</option>
            <option value="change">Change</option>
            <option value="share">Share</option>
            <option value="retain">Retain</option>
        </select>

        <!-- Table for Change option -->
        <table id="table-change" style="display:none;">
            <thead>
                <tr>
                    <th>Risk Response Activity</th>
                    <th>Action Owner</th>
                    <th>Action Due Date</th>
                    <th>Effectivenes of Risk Mitigation Method</th>
                    <th>Current Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="change_field1[]" /></td>
                    
                              <td>
                            <!-- Risk Owner -->
                             <br><br> 
                             <select id='sel_owner' name="sel_owner[1]">
                               <option value='0'></option>
                               
                                <!-- Read Owners -->
                                <?php $__currentLoopData = $owners['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option type="checkbox" value='<?php echo e($owner->User_Id); ?>'><?php echo e($owner->User_Name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                              </select>
                              </td>
                    
                    
                    <td>
                <input type="date"  id="txtDate" required="Required" class="form-control" name="txtDate[]" placeholder="Select suitable date" />
                    </td>
       
                    
                    <td>
                
                              <!-- START DROPDOWN --> 
                                       <select name="Control_Effectiveness[]" id="CE">
                      
                                                <option></option>
                                                <option value="Ineffective">Ineffective (<25%)</option>
                                                <option value="FE">Fairly Effective (25%<50%)</option>
                                                <option value="ME">Mostly Effective (50%<75%)</option>
                                                <option value="Effective">Effective (>75%)</option>
                                                <option value="NA">N/A</option>
                                       </select>
                              
                   </td>
                
                   <td>
                   
                                               <!-- Risk Status -->
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

                    <td><button type="button" class="btn-add-row">+</button></td>
                    <input type="button" value="SAVE">
                </tr>
            </tbody>
        </table>



        <!-- Table for Share option -->
        <table id="table-share" style="display:none;">
            <thead>
                <tr>
                    <th>Risk Response Activity</th>
                    <th>Action Owner</th>
                    <th>Action Due Date</th>
                    <th>Effectivenes of Risk Mitigation Method</th>
                    <th>Current Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="change_field1[]" /></td>
                    
                              <td>
                            <!-- Risk Owner -->
                             <br><br> 
                             <select id='sel_owner' name="sel_owner[1]">
                               <option value='0'></option>
                               
                                <!-- Read Owners -->
                                <?php $__currentLoopData = $owners['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option type="checkbox" value='<?php echo e($owner->User_Id); ?>'><?php echo e($owner->User_Name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                              </select>
                              </td>
                    
                    
                    <td>
                <input type="date"  id="txtDate" required="Required" class="form-control" name="txtDate" placeholder="Select suitable date" />
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
                   
                   
                   

                    <td><button type="button" class="btn-add-row">+</button></td>
                </tr>
            </tbody>
        </table>

        <br /><br />
        <button type="submit">Submit</button>
    </form>

    <script>
          $(document).ready(function() {
              // Show/hide tables based on selected option in dropdown
              $('#dropdown').change(function() {
                  if ($(this).val() === 'change') {
                      $('#table-change').show();
                      $('#table-share').hide();
                  } else if ($(this).val() === 'share') {
                      $('#table-share').show();
                      $('#table-change').hide();
                  } else {
                      $('#table-change').hide();
                      $('#table-share').hide();
                  }
              });
          
              // Add/remove rows dynamically
                      $('.btn-add-row').click(function() {
          var html = '<tr>';
          html += '<td><input type="text" name="change_field1[]" /></td>';
          html += '<td><select name="sel_owner[]"><option value="0"></option></select></td>';
          html += '<td><input type="date" required="Required" class="form-control" name="txtDate[]" placeholder="Select suitable date" /></td>';
          html += '<td><select name="Control_Effectiveness[]"><option></option><option value="Ineffective">Ineffective (<25%)</option><option value="FE">Fairly Effective (25%<50%)</option><option value="ME">Mostly Effective (50%<75%)</option><option value="Effective">Effective (>75%)</option><option value="NA">N/A</option></select></td>';
          html += '<td><button type="button" class="btn-remove-row">-</button></td>';
          html += '</tr>';
        
          // Append the new row to the table
          $(this).closest('tbody').append(html);
        
          // Initialize the datepicker and dropdown for the new row
          $('input[type="date"]').last().datepicker();
          $('select').last().select2();
        });
          }); 
</script>
</body>
</html><?php /**PATH /data/RiskRegistry/resources/views/RiskCreation/RiskDemo.blade.php ENDPATH**/ ?>