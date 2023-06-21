<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html>
<head>
<title>PENDING</title>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>

<body>



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


<table>
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



</body>
</html>
<?php /**PATH /data/RiskRegistry/resources/views/Approvals/Pending.blade.php ENDPATH**/ ?>