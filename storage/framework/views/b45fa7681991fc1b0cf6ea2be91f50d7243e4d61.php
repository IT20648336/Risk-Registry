<title>NEW RISKS</title>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<h2 style="color:#4A3B94";align="right">NEW RISKS</h2>
<BR>
<div class="trhover"> 
<?php echo csrf_field(); ?>
<table>

 <thead>
        <tr>
    <th>
    <h5>RISK ID</h5>
    </th>
    <th>
    <h5>RISK NAME</h5>
    </th>
    <th>
    <h5>RISK OWNER</h5>
    </th>
    <th>
    <h5>RISK RESPONSE</h5>
    </th>
    <th>
    <h5>CREATED DATE</h5>
    </th>
    <th>
    <h5></h5>
    </th>
        </tr>
    </thead>
   
   <?php $__currentLoopData = $Risk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <tbody>
        
       
        <tr>
            <td><?php echo e($Risk->Department_Name); ?></td>
            <td><?php echo e($Risk->Topic); ?></td>
            <td><?php echo e($Risk->Owner_Name); ?></td>
            <td><?php echo e($Risk->Request_Status); ?></td>
            //<td><?php echo e($Risk->Date_Time); ?></td>
        </tr>
    </tbody>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table><?php /**PATH /data/RiskRegistry/resources/views/AdminFunctions/NewRisks.blade.php ENDPATH**/ ?>