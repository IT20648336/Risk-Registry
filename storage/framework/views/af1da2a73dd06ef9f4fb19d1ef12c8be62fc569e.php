<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<title>LOGS</title>  
 <table style="width: 100%;height: auto;margin: 0px auto; margin-left:auto; border: hidden;">  
    <tr>
        <td>
            <h4 style="font-size: 18px;">ACTIVITY LOGS</h4><br>
        </td>
      </tr>
 </table>
<div class="trhover"> 	   
<table id="example" class="table table-bordered site_data_datatable" style="padding: -30px; border-style: hidden; width: 98%;">
<thead style="border: 1px solid #E6E6E6;">
<tr>
    <th>
    <h5>DATE TIME</h5>
    </th>
    <th>
    <h5>SOURCE</h5>
    </th>
    <th>
    <h5>TYPE</h5>
    </th> 
    <th>
    <h5>IP</h5>
    </th>
    <th>
    <h5>MODULE</h5>
    </th>
    <th>
    <h5>DESCRIPTION</h5>
    </th>
</tr>
</thead>
<tbody style="border-top-style:hidden; border-bottom-style:hidden;">
<?php $__currentLoopData = $LogsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td>
<h4><?php echo e($data->Date_Time); ?></h4>
</td> 
<td>
<h4><?php echo e($data->Source); ?></h4>
</td>
<td>
<h4><?php echo e($data->Type); ?></h4>
</td>
<td>
<h4><?php echo e($data->IP_Address); ?></h4>
</td>
<td>
<h4><?php echo e($data->Module); ?></h4>
</td>
<td>
<h4><?php echo e($data->Description); ?></h4>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
<br>
</div>


<?php /**PATH /data/RiskRegistry/resources/views//Logs/ActivityLogs.blade.php ENDPATH**/ ?>