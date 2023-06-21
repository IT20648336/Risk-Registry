<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html>
<head>
<title>NEW RISKS</title>
</head>

<body>
<h2 style="color:#4A3B94;position:absolute;left:324px";align="right">NEW RISKS</h2>


<br><br>
<form method="post" align="center" enctype="multipart/form-data" id="MyRisks" >
<?php echo csrf_field(); ?>
<table >
<thead style="border: 1px solid #E6E6E6;">
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
    <th>
   
   
</tr>
</thead>
<tbody style="border-top-style:hidden; border-bottom-style:hidden;">

<?php $__currentLoopData = $Risk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<tr>
    <td>
    <h4><?php echo e($data->Id); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Topic); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Owner_Name); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Status); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Date_Time); ?></h4>
    </td>
    <td>
  <h4>
                            <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="VIEW"
                                data-toggle="modal" data-target="#ViewRiskData"
                                onclick="ViewRiskData('ViewRiskData?RiskId=<?php echo e($data->Id); ?>'); return false;" />
                        </h4> 
     </td>
     </tr>
    
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
</form>


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






<!-- Extract Details By Dates -->
<form action="/FilterDates" method="GET">
<table style="width:90%; margin: 0px;"> 
<tr>

<td>
  <label for="start_date" class="start-date-label">FROM:</label>
  <input type="date" id="start_date" name="start_date">
</td>

<td>
  <label for="end_date" class="end-date-label">TO:</label>
  <input type="date" id="end_date" name="end_date">
</td>  
<!-- -->
<input type="hidden" name="action" value="extract">
<!-- --> 
<td>  
  <button type="submit" id="extract-btn" class="btn btn-primary" formtarget="_blank">EXTRACT</button>
  
</td>



</tr>  
   
</table>  
</form>


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
</html>


<?php /**PATH /data/RiskRegistry/resources/views//AdminFunctions/NewRisks.blade.php ENDPATH**/ ?>