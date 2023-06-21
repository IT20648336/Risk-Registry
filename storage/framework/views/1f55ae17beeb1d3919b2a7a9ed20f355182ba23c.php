<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>NOT ATTENDED RISKS</title>
    <script src="<?php echo e(asset('tinymce/js/tinymce/tinymce.min.js')); ?>"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<form action="<?php echo e(route('extractNotAttended')); ?>" method="GET">
    <table style="width:90%; margin: 0px;">
        <tr>
            <td>
                <select style="width:90%; height: 30px;" name="risk_status_1" id="risk_status_1" class="DropDown">
                    <option value="">Risk Rationale</option>
                    <option value="avoid">Avoid</option>
                    <option value="share">Share</option>
                    <option value="retain">Retain</option>
                    <option value="change">Change</option>
                </select>
            </td>
            <td>
                <div style="display: flex;">
                    <h5>FROM:&nbsp;</h5><br>
                    <input style="width:90%; height: 30px;" type="date" id="start_date_1" name="start_date_1">
                </div>
            </td>
            <td>
                <div style="display: flex;">
                    <h5>TO:&nbsp;</h5><br>
                    <input style="width:90%; height: 30px;" type="date" id="end_date_1" name="end_date_1">
                </div>
            </td>
            <td>
                <div style="display: flex;">
                    <button type="submit" id="filter-btn" class="button">GO</button>&nbsp;
                    <button type="submit" id="extract-btn" class="button">EXTRACT</button>
                </div>
            </td>
        </tr>
    </table>
</form>

<br>
<br>
<form method="post" align="center" enctype="multipart/form-data" id="MyRisks" >
        <?php echo csrf_field(); ?>
        <div class="scrollit">
            <table>
                <tr>
                    <th>
                        <h5></h5>
                    </th>
                    <th>
                        <h5>RISK INDEX</h5>
                    </th>
                    <th>
                        <h5>RISK OWNER</h5>
                    </th>
                    <th>
                        <h5>ACTION OWNER</h5>
                    </th>
                    <th>
                        <h5>ACTION DUE</h5>
                    </th>
                    <th>
                        <h5>EMAIL</h5>
                    </th>
                    <th>
                        <h5></h5>
                    </th>
                    <th></th>
                </tr>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                    <input type="checkbox" name="selected[]" value="<?php echo e($item->Id); ?>">
                    </td>
                    <td>
                        <h4><?php echo e($item->Id); ?></h4>
                    </td>
                    <td>
                        <h4><?php echo e($item->Owner_Name); ?></h4>
                    </td>
                    <td>
                        <h4><?php echo e($item->Action_Owner_Name); ?></h4>
                    </td>
                    <td>
                        <h4><?php echo e($item->Action_Due); ?></h4>
                    </td>
                    <td>
                        <h4><?php echo e($item->Email); ?></h4>
                    </td>
                    <td>
                        <h4>
                            <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="VIEW"
                                data-toggle="modal" data-target="#ViewRiskData"
                                onclick="ViewRiskData('ViewRiskData?RiskId=<?php echo e($item->Id); ?>'); return false;" />
                        </h4> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
        <br>
        <br>
        <div class="scrollit1">
            <table style="width:100%; margin: 0px;" id="selected_table">
                <thead>
                <tr>
                <th>
                <div style="display: flex;">
                <h5>SELECTED RISKS#:&nbsp;</h5><h4><span id="selected_risks_count"><?php echo e(count($selected_risks ?? [])); ?></span></h4>    
                </div>
                </th>
                </tr>
                
                    <tr>
                        <th><h5>RISK INDEX</h5></th>
                        <th><h5>RISK OWNER</h5></th>
                        <th><h5>ACTION OWNER</h5></th>
                        <th><h5>ACTION DUE</h5></th>
                        <th><h5>EMAIL</h5></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="tbody-wrapper1">
                </tbody>
            </table>
        </div>
    </form>
<br>

<!-- Email BEGIN -->
<table style="width:100%; margin: 0px;"> 
    <tr>
        <td>
            <img src="<?php echo e(asset('images/Email.png')); ?>" style="width: 30px; height: 30px;">
        </td>
    </tr>
    <tr>
        <td style="border:hidden;text-align: left; width:auto;">
            <div style="display: flex;">
                <h5>SUBJECT</h5>&nbsp;
                <input type="text" id="subjectInput" style="width:auto; height: 25px; border: 0px solid #B6B6B6" readonly>
            </div>
        </td>
    </tr>
    <tr>
        <td style="border:hidden;text-align: left; width:auto;">
            <h5>BODY</h5>
            <textarea id="myTextarea"></textarea>
        </td>
    </tr>
    <tr>
        <td style="border:hidden;text-align: center; width:auto;">
            <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="SEND" id="sendButton" />&nbsp;
        </td>
    </tr>
</table>

<div id="ViewRiskData" class="modal fade" role="dialog" style="width:100%;">
    <div class="modal-dialog" style="width:100%;">
        <!-- Modal content-->
        <div class="modal-content" style="width:100%;">
            <div class="modal-body" align="center" style="width:100%;">
                <div id="ViewRiskData1"></div>
            </div>
        </div>
    </div>
</div>

<script>
    tinymce.init({
        selector: '#myTextarea'
    });

$(document).ready(function() {
    var selectedTable = $('#selected_table');
    var selectedRiskIndices = [];

        $('input[name="selected[]"]').on('change', function() {
            var row = $(this).closest('tr');
            var id = $(this).val();
            var riskIndex = row.find('td:eq(1)').text();
            var receiverName = row.find('td:eq(3)').text(); // Get the receiver's name from the "Action Owner" column
            
            if ($(this).is(':checked')) {
                selectedRiskIndices.push(riskIndex);
            } else {
                var index = selectedRiskIndices.indexOf(riskIndex);
                if (index !== -1) {
                    selectedRiskIndices.splice(index, 1);
                }
            }
    
            var subjectInput = $('#subjectInput');
            if (selectedRiskIndices.length > 0) {
                subjectInput.val('Risk Indices: ' + selectedRiskIndices.join(', '));
            } else {
                subjectInput.val('');
            }
            
            var bodyInput = $('#myTextarea');
            var bodyContent = 'Dear ' + receiverName + ',\n\n' + bodyInput.val(); // Modify the email body with the receiver's name
            bodyInput.val(bodyContent);
        });

        $('#sendButton').on('click', function() {
            var receiverEmails = [];
            var selectedRiskIndicesWithEmail = [];
        
            selectedTable.find('tbody tr').each(function() {
                var email = $(this).find('td:nth-child(5)').text();
                if (email.trim() !== '') {
                    receiverEmails.push(email);
        
                    var riskIndex = $(this).find('td:nth-child(1)').text();
                    if (selectedRiskIndices.includes(riskIndex)) {
                        selectedRiskIndicesWithEmail.push(riskIndex);
                    }
                }
            });
        
            var subject = '';
            if (selectedRiskIndicesWithEmail.length > 0) {
                subject = 'Risk Indices: ' + selectedRiskIndicesWithEmail.join(', ');
            } else {
                subject = '';
            }
        
            var body = tinymce.get('myTextarea').getContent();
        
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var emailData = {
                _token: csrfToken,
                receiverEmails: receiverEmails,
                subject: subject,
                body: body,
                selectedRiskIndices: selectedRiskIndicesWithEmail,
            };
            swal({
                title: 'Sending Email',
                text: 'Please wait...',
                buttons: false,
                closeOnEsc: false,
                closeOnClickOutside: false,
                icon: 'info'
            });
        
            $.ajax({
                url: "/not-attended-email",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: emailData,
                success: function(response) {
                    swal.close();
            
                    swal({
                        type: 'success',
                        title: 'Reminder Email',
                        text: 'Emails Sent Successfully!'
                    }).then(function() {
                        $('#emailMessage').text('Emails sent successfully').removeClass('error').addClass('success');
                    });
                },
                error: function(xhr, status, error) {
                    swal.close();
            
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Failed to Send Emails!'
                    }).then(function() {
                        $('#emailMessage').text('Failed to send emails').removeClass('success').addClass('error');
                    });
                }
            });
        });
    });

        $(document).ready(function(){
          var selectedTable = $('#selected_table');
          var selectedCount = $('#selected_risks_count');
          var removeButtonClass = 'remove-selected-risk';
      
          function updateSelectedCount() {
              var count = selectedTable.find('tbody tr').length;
              selectedCount.text(count);
          }
      
          $('input[name="selected[]"]').on('change', function() {
              var row = $(this).closest('tr');
              var id = $(this).val();
      
              if($(this).is(':checked')) {
                  var rowIndex = row.index() + 1;
                  var riskIndex = row.find('td:eq(1)').text();
                  var riskOwner = row.find('td:eq(2)').text();
                  var actionOwner = row.find('td:eq(3)').text();
                  var actionDueDate = row.find('td:eq(4)').text();
                  var email = row.find('td:eq(5)').text();
      
                  var newRow = $('<tr>');
                  newRow.append($('<td>').html('<h4>'+riskIndex+'</h4>'));
                  newRow.append($('<td>').html('<h4>'+riskOwner+'</h4>'));
                  newRow.append($('<td>').html('<h4>'+actionOwner+'</h4>'));
                  newRow.append($('<td>').html('<h4>'+actionDueDate+'</h4>'));
                  newRow.append($('<td>').html('<h4>'+email+'</h4>'));
                  newRow.append($('<td>').html('<button type="button" class="remove-button ' + removeButtonClass + '">Remove</button>'));
      
                  newRow.attr('data-id', id);
      
                  selectedTable.find('tbody').append(newRow);
      
                  updateSelectedCount();
              } else {
                  var selectedRow = selectedTable.find('tr[data-id="' + id + '"]');
                  selectedRow.remove();
      
                  updateSelectedCount();
              }
          });
      
          $(document).on('click', '.' + removeButtonClass, function() {
              var row = $(this).closest('tr');
              var id = row.attr('data-id');
      
              var originalRow = $('input[name="selected[]"][value="' + id + '"]').closest('tr');
              originalRow.find('input[type="checkbox"]').prop('checked', false);
      
              row.remove();
      
              updateSelectedCount();
          });
      });
    </script>
    
    
    
    <!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="modal-body" align="center" style="width:100%;">
<div id="ViewRiskData1">
</div>
</div>
 </div>
</div>
</div>





    
    
    
    
    
</body>
</html><?php /**PATH /data/RiskRegistry/resources/views//AdminFunctions/NotAttendedRisks.blade.php ENDPATH**/ ?>