<br>
<table style="width: 95%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK HISTORY</h4><br>
     </td>
     </tr>
     <tr>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">DATE TIME</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">USER</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">DESCRIPTION</h5>
    </th>   
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">PREVIOUS VALUE</h5>
    </th>  
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">CURRENT VALUE</h5>
    </th>  
    </tr>
<?php $__currentLoopData = $RisksHistoryData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $HistoryData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <tr>
     <td style="text-align: left;">
     <h4><?php echo e($HistoryData->Date_Time); ?></h4>
     </td>
     <td style="text-align: left;">
     <h4><?php echo e($HistoryData->Username); ?></h4>
     </td>
     <td style="text-align: left;">
     <h4><?php echo e($HistoryData->Description); ?></h4>
     </td>
     <td style="text-align: left;">
     <h4><?php echo e($HistoryData->Previous_Value); ?></h4>
     </td>
     <td style="text-align: left;">
     <h4><?php echo e($HistoryData->Current_Value); ?></h4>
     </td>
     </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<br><?php /**PATH /data/RiskRegistry/resources/views/Risk/ViewRiskHistory.blade.php ENDPATH**/ ?>