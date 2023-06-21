

<?php $__env->startSection('content'); ?>
    <table>
        <tr>
            <th>RISK ID</th>
            <th>RISK NAME</th>
            <th>RISK OWNER</th>
            <th>RISK RESPONSE</th>
            <th>CREATED DATE</th>
        </tr>
        <?php $__currentLoopData = $filteredData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($data->Id); ?></td>
                <td><?php echo e($data->Topic); ?></td>
                <td><?php echo e($data->Owner_Name); ?></td>
                <td><?php echo e($data->Status); ?></td>
                <td><?php echo e($data->Date_Time); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/Risk/FilteredRisks.blade.php ENDPATH**/ ?>