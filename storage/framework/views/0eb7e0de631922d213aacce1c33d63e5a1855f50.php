<table class="table table-success table-striped">

  <thead>
    <tr>
      <th>Name</th>
      <th>Contact Person</th>
      <th>Mobile</th>
      <th>Email</th>
    </tr>
  </thead>

  <tbody>
    <?php $__currentLoopData = $company1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
          <td><?php echo e($company['name']); ?></td>
          <td><?php echo e($company['contact_person']); ?></td>
          <td><?php echo e($company['mobile']); ?></td>
          <td><?php echo e($company['email']); ?></td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
  </tbody>
  </table><?php /**PATH /data/RiskRegistry/resources/views/companylist.blade.php ENDPATH**/ ?>