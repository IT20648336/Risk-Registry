<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html>
<head>
<title>NOTIFICATION</title>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>

<body>

<h2 style="color:#4A3B94;position:absolute;left:285px;font-size:15px;" align="right">Notification</h2>

<style>
    td {
        font-weight: bold;
        color:black;
        font-size:12px;
    }
    /* ... */
    .hidden {
        display: none;
    }
</style>


<table style="position: absolute; top: 8%; left: 18%; right: 0; width: 80%; height: auto; margin: 0; border: hidden;">
  <thead>
    <tr>
      <th>Id</th>
      <th>Topic</th>
      <th>Request Type</th>
      <th>Status</th>
      <th>Email</th>
      <th style="display: none;">Description</th>
      <th style="display: none;">Subject</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php $__currentLoopData = $risks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $risk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr data-risk-id="<?php echo e($risk->Id); ?>" data-risk-status="<?php echo e($risk->Email_Status); ?>">
        <td><?php echo e($risk->Id); ?></td>
        <td><?php echo e($risk->Topic); ?></td>
        <td><?php echo e($risk->Request_Type); ?></td>
        <td>
          <span class="status-dot <?php echo e($risk->Email_Status === 'approved' ? 'green' : 'red'); ?>"></span>
          <?php echo e($risk->Email_Status); ?>

        </td>
        <td><?php echo e($risk->Email); ?></td>
        <td style="display: none;"><?php echo e($risk->Description); ?></td>
        <td style="display: none;"><?php echo e($risk->Subject); ?></td>
        <td>
          <button class="notificationviewbtn">View</button>
          <button class="notificationacceptbtn" data-risk-id="<?php echo e($risk->Id); ?>">Approve</button>
          <button class="notificationremovebtn" data-risk-id="<?php echo e($risk->Id); ?>">Reject</button>
          <textarea class="reject-text hidden"></textarea>
        </td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>

<script>
$(document).ready(function() {
  // Retrieve the CSRF token
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  $('.notificationacceptbtn, .notificationremovebtn').click(function() {
    var button = $(this);
    var riskId = button.data('risk-id');
    var status = button.hasClass('notificationacceptbtn') ? 'approved' : 'rejected';
    
       if (status === 'rejected') {
            var textarea = button.siblings('.reject-text');
            textarea.removeClass('hidden');
        }

    $.ajax({
      url: '/update-email-status/' + riskId + '/' + status,
      type: 'PUT',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function(response) {
        // Handle the success response
        console.log(response);

        // Update the status in the table without reloading the page
        var row = button.closest('tr');
        var statusCell = row.find('td:nth-child(4)');
        var statusDot = statusCell.find('.status-dot');

        statusCell.text(status);
        statusDot.removeClass('red green').addClass(status === 'approved' ? 'green' : 'red');
      },
      error: function(xhr, status, error) {
        // Handle the error response
        console.error(error);
      }
    });
  });
});
</script>

</body>
</html>
<?php /**PATH /data/RiskRegistry/resources/views/Email/Notification.blade.php ENDPATH**/ ?>