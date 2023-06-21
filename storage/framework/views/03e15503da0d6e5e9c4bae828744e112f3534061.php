<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<title>My Risk's </title>

<table>
<tr>
    <th>
    <h5>CREATED DATE</h5>
    </th>
    <th>
    <h5>RISK ID</h5>
    </th>
     <th>
    <h5>RISK TYPE</h5>
    </th>
    <th>
    <h5>RISK TOPIC</h5>
    </th>
     <th>
    <h5>RISK CATEGORY</h5>
    </th>
    <th>
    <h5>CREATED PERSON</h5>
    </th>
    <th>
    <h5>RISK RESPONSE</h5>
    </th>
    <th>
    <h5>UPDATED DATE</h5>
    </th>
    <th>
    <h5>ACTION</h5>
    </th>
   
</tr>

<?php $__currentLoopData = $Risk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<tr>
    <td>
    <h4><?php echo e($data->Date_Time); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Id); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Type); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Topic); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Category); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Owner_Name); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Request_Status); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Last_Updated); ?></h4>
    </td>
    <td>
    <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="VIEW" data-toggle="modal"/>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<?php /**PATH /data/RiskRegistry/resources/views//Test/MyRisks.blade.php ENDPATH**/ ?>