<?php $__currentLoopData = $RisksData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<br>
<form method="post" align="center" enctype="multipart/form-data" id="OpenRiskData">
<?php echo csrf_field(); ?>
<table style="width: 95%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK REVIEW</h4><br>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>COMPANY:</b></h5>
     <h4><?php echo e($data->Company_Name); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>DEPARTMENT:</b></h5>
     <h4><?php echo e($data->Department_Name); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>DIVISION:</b></h5>
     <h4><?php echo e($data->Division_Name); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>TYPE:</b></h5>
     <h4><?php echo e($data->Type); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>TOPIC:</b></h5>
     <h4><?php echo e($data->Topic); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>DESCRIPTION:</b></h5>
     <h4><?php echo e($data->Description); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>OBJECTIVE:</b></h5>
     <h4><?php echo e($data->Objective); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>CATEGORY:</b></h5>
     <h4><?php echo e($data->Category); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>SUB CATEGORY:</b></h5>
     <h4><?php echo e($data->Sub_Category); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>REPORTER:</b></h5>
     <h4><?php echo e($data->Created_User_Name); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>OWNER:</b></h5>
     <h4><?php echo e($data->Owner_Name); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>OWNER DIVISION:</b></h5>
     <h4><?php echo e($data->Risk_Division_Name); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
    <h5><b>KEY RISK INDICATORS:</b></h5>
    <table style="width: 100%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">KRI</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">STATUS</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">TOLERANCE</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">APPETITE</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">THRESHOLD</h5>
    </th>    
    </tr>
    <?php $__currentLoopData = $KRIData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $KRI): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($KRI->KRI); ?></h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($KRI->Current_Status); ?></h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($KRI->Risk_Tolerance); ?></h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($KRI->Risk_Appetite); ?></h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($KRI->Risk_Threshold); ?></h4>
     </td>
     </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
     </table>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>ROOT CAUSE:</b></h5>
     <h4><?php echo e($data->Root_Cause); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>IMPACT:</b></h5>
     <h4><?php echo e($data->Impact); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>CONTROL EFFECTIVENESS:</b></h5>
     <h4><?php echo e($data->Control_Effectiveness); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>DIVISION:</b></h5>
     <h4><?php echo e($data->Division_Name); ?></h4>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <h5><b>STATUS:</b></h5>
     <h4><?php echo e($data->Status); ?></h4>
     </td>
     </tr>
    <?php
    if($data->Status == 'Share' || $data->Status == 'Change'){
    ?>
     <tr>
    <td style="border:hidden;text-align: left; width:50%;">
    <table style="width: 100%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">RESPONSE ACTIVITY</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">ACTION OWNER</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">ACTION DUE</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">STATUS</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">MITIGATION METHOD</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">ACTION STATUS</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;"></h5>
    </th>
    </tr>
    <?php $__currentLoopData = $TreatmentData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $TreatmentDataRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
    date_default_timezone_set('Asia/Colombo');
    $SystemDate=date('Y-m-d', time());
    if($TreatmentDataRow->Action_Due < $SystemDate):
    $ActionDelayColor = '#FFE9E9';
    $ActionFontDelayColor='#A50000';
    $Status='Delayed';
    else:
    $ActionDelayColor = '#E6FFE3';
    $ActionFontDelayColor='#0F8E00';
    $Status='On-Time';
    endif;
    ?>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($TreatmentDataRow->Activity); ?></h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($TreatmentDataRow->Action_Owner_Name); ?></h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($TreatmentDataRow->Action_Due); ?></h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="background-color:<?php echo e($ActionDelayColor); ?>; border-radius: 5px;padding: 0px 0px; width:auto; display: inline-block; color:#FFFFFF;text-align: center;">
     <h4 style="color:<?php echo e($ActionFontDelayColor); ?>;">&nbsp;<?php echo e($Status); ?>&nbsp;</h4>
     </div>
     </div>
     </td>
     <?php
     if($TreatmentDataRow->Action_Owner_Username == $Current_User && $data->Request_Status == 'In-Progress'){
     ?>
     <td style="border:hidden;text-align: left; width:auto;">
     <select style="width:90%; height: 30px;" name="RiskTreatmentMitigation_<?php echo e($TreatmentDataRow->Id); ?>" id="RiskTreatmentMitigation_<?php echo e($TreatmentDataRow->Id); ?>" class="DropDown"> 
      <option value="<?php echo e($TreatmentDataRow->Mitigation_Method); ?>"><?php echo e($TreatmentDataRow->Mitigation_Method); ?></option>
      <option value="Ineffective (<25%)">Ineffective (<25%)</option>
      <option value="Fairly Effective (25%<50%)">Fairly Effective (25%<50%)</option>
      <option value="Mostly Effective (50%<75%)">Mostly Effective (50%<75%)</option>
      <option value="Effective (>75%)">Effective (>75%)</option> 
     </select>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <select style="width:90%; height: 30px;" name="RiskTreatmentStatus_<?php echo e($TreatmentDataRow->Id); ?>" id="RiskTreatmentStatus_<?php echo e($TreatmentDataRow->Id); ?>" class="DropDown"> 
      <option value="<?php echo e($TreatmentDataRow->Status); ?>"><?php echo e($TreatmentDataRow->Status); ?></option>
      <option value="Abandoned">Abandoned</option>
      <option value="Completed (delay)">Completed (delay)</option>
      <option value="Completed (early)">Completed (early)</option>
      <option value="Completed (on time)">Completed (on time)</option>
      <option value="Manage with existing controls">Manage with existing controls</option>
      <option value="Not started">Not started</option>
      <option value="Ongoing (ahead of time)">Ongoing (ahead of time)</option>
      <option value="Ongoing (on time)">Ongoing (on time)</option>
      <option value="Ongoing (with delays)">Ongoing (with delays)</option>
      <option value="Redirected">Redirected</option>
     </select>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="SAVE" onclick="UpdateTreatmentData('UpdateTreatmentData?Id=<?php echo e($TreatmentDataRow->Id); ?>&RiskId=<?php echo e($TreatmentDataRow->Risk_Id); ?>'); return false;" />&nbsp;
     </td>
     <?php
     }
     if($TreatmentDataRow->Action_Owner_Username != $Current_User || $data->Request_Status != 'In-Progress'){
     ?>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($TreatmentDataRow->Mitigation_Method); ?></h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($TreatmentDataRow->Status); ?></h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;"></td>
     <?php
     }
    ?>
     </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
     </table>
     </td>
     </tr>
     <?php
     }
    ?>
</table>
<br>
<?php
if($CloseButton == '1' && $data->Request_Status == 'In-Progress'){
?>
<input class="button" style="height: 20px; margin-top: 1px; background-color:" type="button" value="CLOSE" onclick="CloseRisk('CloseRisk?RiskId=<?php echo e($data->Id); ?>'); return false;" />
<br>
<?php
}
if($data->Request_Status == 'Completed'){
?>
<input class="button" style="height: 20px; margin-top: 1px; background-color:" type="button" value="RE-OPEN" onclick="ReOpenRisk('ReOpenRisk?RiskId=<?php echo e($data->Id); ?>'); return false;" />
<br>
<?php
}
?>
</form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /data/RiskRegistry/resources/views/Risk/ViewRisk.blade.php ENDPATH**/ ?>