<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<title>RISK</title>
<?php
if($CurrentPage == '1'){
?>
<form method="post" Action="RiskCreation?RiskId=<?php echo e($RiskId); ?>&Page=<?php echo e($NextPage); ?>" align="center" enctype="multipart/form-data" id="RiskDataStep_1">
<?php echo csrf_field(); ?>
<table style="width: 90%;height: auto;margin: 0px auto; margin-left:auto; border: hidden;">  
    <tr>
        <td>
            <h4 style="font-size: 18px;">DIVISION SELECTION</h4><br>
        </td>
      </tr>
<?php
if(!empty($RisksData)){
?>
<?php $__currentLoopData = $RisksData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
      <td style="border:hidden;text-align: left; width:50%">
      <label for="Student"><b>DIVISION:</b></label><br>                      
      <select style="width:100%;" name="Division_Id" id="Division_Id" class="DropDown" onchange="GetDivisionDataRC('GetDivisionDataRC'); return false;" required> 
      <option value="<?php echo e($data->Division_Id); ?>"><?php echo e($data->Division_Name); ?></option>
      <?php $__currentLoopData = $Divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $DivisionData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($DivisionData->Division_Id); ?>"><?php echo e($DivisionData->Division_Name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>                      
     </td>
     <td style="border:hidden;text-align: left;">
      <label for="Student"><b>TYPE:</b></label><br>                      
      <select style="width:100%;" name="Type" id="Type" class="DropDown" required> 
      <option value="<?php echo e($data->Type); ?>"><?php echo e($data->Type); ?></option>
      <option value="Divisional">Divisional</option>
      <option value="ERM">ERM</option>
      </select>                      
     </td>
     </tr>
     <tr>
        <td style="border:hidden;text-align: left;">
            <label for="Student"><b>DEPARTMENT:</b></label><br>
            <input style="width:100%;" type="text" id="Department_Name" name="Department_Name" readonly value="<?php echo e($data->Department_Name); ?>" required/>
        </td>
        <td style="border:hidden;text-align: left;">
            <label for="Student"><b>COMPANY:</b></label><br>
            <input style="width:100%;" type="text" id="Company_Name" name="Company_Name" readonly value="<?php echo e($data->Company_Name); ?>" required />
        </td>
     </tr>
<input type="hidden" id="Company_Id" name="Company_Id" value="<?php echo e($data->Company_Id); ?>" />
<input type="hidden" id="Division_Name" name="Division_Name" value="<?php echo e($data->Division_Name); ?>" />
<input type="hidden" id="Department_Id" name="Department_Id" value="<?php echo e($data->Department_Id); ?>" />
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php
}
if(empty($RisksData)){
?>
<tr>
      <td style="border:hidden;text-align: left; width:50%">
      <label for="Student"><b>DIVISION:</b></label><br>                      
      <select style="width:100%;" name="Division_Id" id="Division_Id" class="DropDown" onchange="GetDivisionDataRC('GetDivisionDataRC'); return false;" required> 
      <option value="">-SELECT-</option>
      <?php $__currentLoopData = $Divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $DivisionData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($DivisionData->Division_Id); ?>"><?php echo e($DivisionData->Division_Name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>                      
     </td>
     <td style="border:hidden;text-align: left;">
      <label for="Student"><b>TYPE:</b></label><br>                      
      <select style="width:100%;" name="Type" id="Type" class="DropDown" required> 
      <option value="">-SELECT-</option>
      <option value="Divisional">Divisional</option>
      <option value="ERM">ERM</option>
      </select>                      
     </td>
     </tr>
     <tr>
        <td style="border:hidden;text-align: left;">
            <label for="Student"><b>DEPARTMENT:</b></label><br>
            <input style="width:100%;" type="text" id="Department_Name" name="Department_Name" readonly required />
        </td>
        <td style="border:hidden;text-align: left;">
            <label for="Student"><b>COMPANY:</b></label><br>
            <input style="width:100%;" type="text" id="Company_Name" name="Company_Name" readonly  required />
        </td>
     </tr>
<input type="hidden" id="Company_Id" name="Company_Id" />
<input type="hidden" id="Division_Name" name="Division_Name"  />
<input type="hidden" id="Department_Id" name="Department_Id" />
<?php
}
?>
     <tr>
        <td style="border:hidden;text-align: left;"><br>
        </td>
        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="NEXT" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
</form>
<?php
}
if($CurrentPage == '2'){
?>
<?php $__currentLoopData = $RisksData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<form method="post" Action="RiskCreation?RiskId=<?php echo e($RiskId); ?>&Page=<?php echo e($NextPage); ?>" align="center" enctype="multipart/form-data" id="RiskDataStep_2">
<?php echo csrf_field(); ?>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK IDENTIFICATION</h4><br>
     </td>
     </tr>
     <tr>
     <td colspan="2" style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>TOPIC:</b></label><br>  
     <input style="width:100%;" type="text" id="Topic" name="Topic" value="<?php echo e($data->Topic); ?>" required />
     </td>
     </tr>
     <tr>
     <td colspan="2" style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>DESCRIPTION:</b></label><br>
     <textarea style="width:100%;" id="Description" name="Description" rows="4" cols="100" required><?php echo e($data->Description); ?></textarea>
     </td>
     </tr>
     <tr>
     <td colspan="2" style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>OBJECTIVE IMPACTED BY THE RISK:</b></label><br>
     <textarea style="width:100%;" id="Objective" name="Objective" rows="4" cols="100" required><?php echo e($data->Objective); ?></textarea>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>CATEGORY:</b></label><br>
     <select style="width:100%;" name="RiskCategory" id="RiskCategory" class="DropDown" onchange="GetSubRiskCategory('GetSubRiskCategory'); return false;" required> 
      <option value="<?php echo e($data->Category); ?>"><?php echo e($data->Category); ?></option>
      <?php $__currentLoopData = $Category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $CategoryData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($CategoryData->Category); ?>"><?php echo e($CategoryData->Category); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select> 
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>SUB CATEGORY:</b></label><br>
     <select style="width:100%;" name="SubRiskCategory" id="SubRiskCategory" class="DropDown" required > 
      <option value="<?php echo e($data->Sub_Category); ?>"><?php echo e($data->Sub_Category); ?></option>
      </select>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>OWNER:</b></label><br>
     <select style="width:100%;" name="Owner_Id" id="Owner_Id" class="DropDown" onchange="GetRiskOwnerName('GetRiskOwnerName'); return false;" required> 
      <option value="<?php echo e($data->Owner_Username); ?>"><?php echo e($data->Owner_Name); ?></option>
      <?php $__currentLoopData = $Users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $UsersData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($UsersData->User_Name); ?>"><?php echo e($UsersData->Name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select> 
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>DIVISION:</b></label><br>
     <select style="width:100%;" name="Division_Id" id="Division_Id" class="DropDown" onchange="GetRiskDivisionName('GetRiskDivisionName'); return false;" required > 
      <option value="<?php echo e($data->Risk_Division_Id); ?>"><?php echo e($data->Risk_Division_Name); ?></option>
      <?php $__currentLoopData = $Divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $DivisionData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($DivisionData->Id); ?>"><?php echo e($DivisionData->Name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </select>
     </td>
     </tr>
     <tr>
        <td style="border:hidden;text-align: left;"><br>
        <input class="button" align="right" type="button" value="BACK" style="width:25%; height: 25px; background-color: #D3D3D3; color:#000000;" onclick="location.href='RiskCreationBack?RiskId=<?php echo e($RiskId); ?>&Page=1'" />
        </td>
        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="NEXT" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
<input type="hidden" id="Risk_Division_Name" name="Risk_Division_Name" value="<?php echo e($data->Risk_Division_Name); ?>"/>
<input type="hidden" id="Owner_Name" name="Owner_Name" value="<?php echo e($data->Owner_Name); ?>" />
</form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php
}
if($CurrentPage == '3'){
?>
<?php $__currentLoopData = $RisksData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<form method="post" Action="RiskCreation?RiskId=<?php echo e($RiskId); ?>&Page=<?php echo e($NextPage); ?>" align="center" enctype="multipart/form-data" id="RiskDataStep_3">
<?php echo csrf_field(); ?>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK ANALYSIS</h4><br>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>Key Risk Indicator(KRI)</b></label><br>
     </td>
     </tr>
     <tr>
     <td colspan="4" style="border:hidden;text-align: left; width:auto;">
    <table style="width: 100%;height: auto;margin: 0px auto; border: hidden;" id="KRIDataTable" class="KRIDataTable"> 
    <tr>
     <td colspan="5" style="border:hidden;text-align: left; width:auto;">
     <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="AddKRIData">
     <input class="button" align="right" type="button" value="Add(+)"/>
     </a>
     <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="RemoveKRIData">
     <input class="button" align="right" type="button" value="Remove(-)" style="background-color: #D3D3D3; color:#000000;"/>
     </a>
     </td>
     </tr>
    <tr>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">KRI</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">CURRENT STATUS</h5>
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
    <?php $__currentLoopData = $KRIData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $KRIDataRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="KRI[]" id="KRI[]" value="<?php echo e($KRIDataRow->KRI); ?>" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Current_Status[]" id="Current_Status[]" value="<?php echo e($KRIDataRow->Current_Status); ?>" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Tolerance[]" id="Tolerance[]" value="<?php echo e($KRIDataRow->Risk_Tolerance); ?>" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Appetite[]" id="Appetite[]" value="<?php echo e($KRIDataRow->Risk_Appetite); ?>" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="Threshold[]" id="Threshold[]" value="<?php echo e($KRIDataRow->Risk_Threshold); ?>" />
     </td>
     </tr>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>       
     </table>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:auto;">
     <label for="Root_Cause"><b>ROOT CAUSE:</b></label><br>
     <select style="width:100%;" id="Root_Cause" name="Root_Cause" class="DropDown" required>
     <option value="Select"}}>Select</option>
     <option value="People Origin" <?php echo e($data->Root_Cause == 'People Origin' ? 'selected' : ''); ?>>People Origin</option>
     <option value="Process Origin" <?php echo e($data->Root_Cause == 'Process Origin' ? 'selected' : ''); ?>>Process Origin</option>
     <option value="Systems Origin" <?php echo e($data->Root_Cause == 'Systems Origin' ? 'selected' : ''); ?>>Systems Origin</option>
     <option value="People, Process Origin" <?php echo e($data->Root_Cause == 'People, Process Origin' ? 'selected' : ''); ?>>People, Process Origin</option>
     <option value="People, Systems Origin" <?php echo e($data->Root_Cause == 'People, Systems Origin' ? 'selected' : ''); ?>>People, Systems Origin</option>
     <option value="Process, Systems Origin" <?php echo e($data->Root_Cause == 'Process, Systems Origin' ? 'selected' : ''); ?>>Process, Systems Origin</option>
     <option value="People, Process, Systems Origin" <?php echo e($data->Root_Cause == 'People, Process, Systems Origin' ? 'selected' : ''); ?>>People, Process, Systems Origin</option>
     <option value="Other Externality" <?php echo e($data->Root_Cause == 'Other Externality' ? 'selected' : ''); ?>>Other Externality</option>
     </select>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:auto;">
     <label for="Impact"><b>IMPACT:</b></label><br>
     <select style="width:100%;" id="Impact" name="Impact" class="DropDown" required>
     <option value="Select"}}>Select</option>
     <option value="Financial Only" <?php echo e($data->Impact == 'Financial Only' ? 'selected' : ''); ?>>Financial Only</option>
     <option value="Operational Only" <?php echo e($data->Impact == 'Operational Only' ? 'selected' : ''); ?>>Operational Only</option>
     <option value="Regulatory Only" <?php echo e($data->Impact == 'Regulatory Only' ? 'selected' : ''); ?>>Regulatory Only</option>
     <option value="Compliance Only" <?php echo e($data->Impact == 'Compliance Only' ? 'selected' : ''); ?>>Compliance Only</option>
     <option value="Financial, Operational" <?php echo e($data->Impact == 'Financial, Operational' ? 'selected' : ''); ?>>Financial, Operational</option>
     <option value="Financial, Regulatory" <?php echo e($data->Impact == 'Financial, Regulatory' ? 'selected' : ''); ?>>Financial, Regulatory</option>
     <option value="Financial, Compliance" <?php echo e($data->Impact == 'Financial, Compliance' ? 'selected' : ''); ?>>Financial, Compliance</option>
     <option value="Operational, Regulatory" <?php echo e($data->Impact == 'Operational, Regulatory' ? 'selected' : ''); ?>>Operational, Regulatory</option>
     <option value="Operational, Compliance" <?php echo e($data->Impact == 'Operational, Compliance' ? 'selected' : ''); ?>>Operational, Compliance</option>
     <option value="Regulatory, Compliance" <?php echo e($data->Impact == 'Regulatory, Compliance' ? 'selected' : ''); ?>>Regulatory, Compliance</option>
     <option value="Operational, Regulatory, Compliance" <?php echo e($data->Impact == 'Operational, Regulatory, Compliance' ? 'selected' : ''); ?>>Operational, Regulatory, Compliance</option>
     <option value="Financial, Regulatory, Compliance" <?php echo e($data->Impact == 'Financial, Regulatory, Compliance' ? 'selected' : ''); ?>>Financial, Regulatory, Compliance</option>
     <option value="Financial, Operational, Compliance" <?php echo e($data->Impact == 'Financial, Operational, Compliance' ? 'selected' : ''); ?>>Financial, Operational, Compliance</option>
     <option value="Financial, Operational, Regulatory" <?php echo e($data->Impact == 'Financial, Operational, Regulatory' ? 'selected' : ''); ?>>Financial, Operational, Regulatory</option>
     <option value="Financial, Operational, Regulatory, Compliance" <?php echo e($data->Impact == 'Financial, Operational, Regulatory, Compliance' ? 'selected' : ''); ?>>Financial, Operational, Regulatory, Compliance</option>
     </select>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>LIKELIHOOD LEVEL</b></label><br>
     </td>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>IMPACT LEVEL</b></label><br>
     </td>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>GROSS RISK LEVEL</b></label><br>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Likelihood_Level" name="Analysis_Likelihood_Level" value="Rare" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Likelihood_Level'] == 'Rare'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Rare</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Impact_Level" name="Analysis_Impact_Level" value="Insignificant" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Impact_Level'] == 'Insignificant'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Insignificant</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input type="text" style="width:20%;" name="Gross_Risk_Level" id="Gross_Risk_Level" readonly value="<?php echo e($data->Gross_Risk_Level); ?>" required />
     </td>
     </tr> 
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Likelihood_Level" name="Analysis_Likelihood_Level" value="Unlikely" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Likelihood_Level'] == 'Unlikely'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Unlikely</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Impact_Level" name="Analysis_Impact_Level" value="Minor" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Impact_Level'] == 'Minor'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Minor</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Likelihood_Level" name="Analysis_Likelihood_Level" value="Moderate" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Likelihood_Level'] == 'Moderate'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Moderate</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Impact_Level" name="Analysis_Impact_Level" value="Moderate" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Impact_Level'] == 'Moderate'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Moderate</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Likelihood_Level" name="Analysis_Likelihood_Level" value="Likely" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Likelihood_Level'] == 'Likely'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Likely</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Impact_Level" name="Analysis_Impact_Level" value="Major" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Impact_Level'] == 'Major'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Major</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Likelihood_Level" name="Analysis_Likelihood_Level" value="Al.Certain" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Likelihood_Level'] == 'Al.Certain'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Al.Certain</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Analysis_Impact_Level" name="Analysis_Impact_Level" value="Catastrophic" onclick="GetGrossRiskLevel('GetGrossRiskLevel');" <?php if($RisksData['0']['Analysis_Impact_Level'] == 'Catastrophic'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Catastrophic</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
</table>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
        <td style="border:hidden;text-align: left; "><br>
        <input class="button" align="right" type="button" value="BACK" style="width:25%; height: 25px; background-color: #D3D3D3; color:#000000;" onclick="location.href='RiskCreationBack?RiskId=<?php echo e($RiskId); ?>&Page=2'" />
        </td>
        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="NEXT" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
<input type="hidden" id="Division_Name" name="Division_Name"/>
<input type="hidden" id="Owner_Name" name="Owner_Name"/>
</form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php
}
if($CurrentPage == '4'){
?>
<?php $__currentLoopData = $RisksData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<form method="post" Action="RiskCreation?RiskId=<?php echo e($RiskId); ?>&Page=<?php echo e($NextPage); ?>" align="center" enctype="multipart/form-data" id="RiskDataStep_4">
<?php echo csrf_field(); ?>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK EVALUATION</h4><br>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:auto;">
     <label for="Student"><b>EXISTING CONTROL:</b></label><br>  
     <input style="width:100%;" type="text" id="Existing_Control" name="Existing_Control" value="<?php echo e($data->Existing_Control); ?>" required/>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>CONTROL EFFECTIVENESS:</b></label><br>
     <select style="width:100%;" name="Control_Effectiveness" id="Control_Effectiveness" class="DropDown" required> 
      <option value="<?php echo e($data->Control_Effectiveness); ?>"><?php echo e($data->Control_Effectiveness); ?></option>
      <option value="Ineffective (<25%)">Ineffective (<25%)</option>
      <option value="Fairly Effective (25%<50%)">Fairly Effective (25%<50%)</option>
      <option value="Mostly Effective (50%<75%)">Mostly Effective (50%<75%)</option>
      <option value="Effective (>75%)">Effective (>75%)</option>
     </select><br><br>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>LIKELIHOOD LEVEL</b></label><br>
     </td>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>IMPACT LEVEL</b></label><br>
     </td>
     <td style="border:hidden;text-align: center; width:auto;">
     <label for="Student" style="text-align: center;"><b>Residual Risk Level (After Control Effectiveness)</b></label><br>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Likelihood_Level" name="Evaluation_Likelihood_Level" value="Rare" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Likelihood_Level'] == 'Rare'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Rare</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Impact_Level" name="Evaluation_Impact_Level" value="Insignificant" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Impact_Level'] == 'Insignificant'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Insignificant</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input type="text" style="width:20%;" name="Residual_Risk_Level" id="Residual_Risk_Level" readonly value="<?php echo e($RisksData['0']['Residual_Risk_Level']); ?>" required />
     </td>
     </tr> 
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Likelihood_Level" name="Evaluation_Likelihood_Level" value="Unlikely" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Likelihood_Level'] == 'Unlikely'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Unlikely</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Impact_Level" name="Evaluation_Impact_Level" value="Minor" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Impact_Level'] == 'Minor'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Minor</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Likelihood_Level" name="Evaluation_Likelihood_Level" value="Moderate" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Likelihood_Level'] == 'Moderate'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Moderate</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Impact_Level" name="Evaluation_Impact_Level" value="Moderate" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Impact_Level'] == 'Moderate'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Moderate</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Likelihood_Level" name="Evaluation_Likelihood_Level" value="Likely" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Likelihood_Level'] == 'Likely'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Likely</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Impact_Level" name="Evaluation_Impact_Level" value="Major" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Impact_Level'] == 'Major'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Major</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Likelihood_Level" name="Evaluation_Likelihood_Level" value="Al.Certain" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Likelihood_Level'] == 'Al.Certain'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Almost Certain</h5></div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
     <input type="radio" id="Evaluation_Impact_Level" name="Evaluation_Impact_Level" value="Catastrophic" onclick="GetResidualRiskLevel('GetResidualRiskLevel');" <?php if($RisksData['0']['Evaluation_Impact_Level'] == 'Catastrophic'){?> checked="checked" <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Catastrophic</h5>
     </div>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     </td>
     </tr>
</table>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
        <td style="border:hidden;text-align: left;"><br>
          <input class="button" align="right" type="button" value="BACK" style="width:25%; height: 25px; background-color: #D3D3D3; color:#000000;" onclick="location.href='RiskCreationBack?RiskId=<?php echo e($RiskId); ?>&Page=3'" />
        </td>

        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="NEXT" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
<input type="hidden" id="Division_Name" name="Division_Name"/>
<input type="hidden" id="Owner_Name" name="Owner_Name"/>
</form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php
}
if($CurrentPage == '5'){
?>
<?php $__currentLoopData = $RisksData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<form method="post" Action="RiskCreation?RiskId=<?php echo e($RiskId); ?>&Page=<?php echo e($NextPage); ?>" align="center" enctype="multipart/form-data" id="RiskDataStep_5">
<?php echo csrf_field(); ?>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK MITIGATION</h4><br>
     </td>
     </tr>
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>Risk Treatment Option:</b></label><br>
     <select style="width:100%;" name="Risk_Status" id="Risk_Status" class="DropDown" onchange="GetRiskStatusTypes('GetRiskStatusTypes');" required > 
      <option value="<?php echo e($data->Status); ?>"><?php echo e($data->Status); ?></option>
      <option value="Avoid" data-bs-toggle="tooltip" data-bs-placement="right" title="By informed decision, avoid a risky situation. If doing an activity is a risk Not doing it. If stopping an activity is a risk- Not stopping it.">Avoid</option>
      <option value="Change" data-bs-toggle="tooltip" data-bs-placement="right" title="By informed decision, Risk Owners decide to retain or accept the risk and undertakes to manage both impact and likelihood of the risk">Change</option>
      <option value="Share" data-bs-toggle="tooltip" data-bs-placement="right" title="Eliminate the source of risk or reduce the likelihood of occurance (with preventive controls) and/ or minimise the impact (with corrcetive/ compensating controls)">Share</option>
      <option value="Retain" data-bs-toggle="tooltip" data-bs-placement="right" title="Transfer or share part of the risk (i.e., burden of loss) to a third party. This usually involves a cost to financially tranfer the risk (eg. Insurance, Outsourcing, etc.)">Retain</option>
     </select><br><br>
     </td>
     </tr>
</table>
<div style="<?php if($RisksData['0']['Status'] != 'Avoid'){?> display:none; <?php } ?>" id="TreatmentDivAvoid">
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;" id="TreatmentTableAvoid" class="TreatmentTableAvoid">  
     <tr>
     <td colspan="3" style="border:hidden;text-align: left; width:auto;">
     <div style="display: flex;">
      <label for="Student" style="text-align: center;"><b>ACCEPTANCE:</b></label>&nbsp;
     <input type="radio" id="Evaluation_Likelihood_Level" name="Avoid_Acceptance_Status" value="Accepted" onclick="GetAvoidAcceptanceAttachment('GetAvoidAcceptanceAttachment');" <?php if($RisksData['0']['Acceptance'] == 'Accepted'){?> checked <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Accepted</h5>&nbsp;&nbsp;&nbsp;
     <input type="radio" id="Evaluation_Impact_Level" name="Avoid_Acceptance_Status" value="Pending" onclick="GetAvoidAcceptanceAttachment('GetAvoidAcceptanceAttachment');" <?php if($RisksData['0']['Acceptance'] == 'Pending'){?> checked <?php } ?> >&nbsp;
     <h5 style="color: #6B6B6B; font-size: 14px; margin-top: 2px;">Pending</h5>
     </div>
     </td>
     </tr>
</table>
</div> 
<div style="<?php if($RisksData['0']['Status'] != 'Share' && $RisksData['0']['Status'] != 'Change' && $RisksData['0']['Status'] != 'Retain'){?> display:none; <?php } ?>" id="TreatmentDivChange">
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;" id="RiskTreatmentChange" class="RiskTreatmentChange"> 
    <tr>
     <td colspan="5" style="border:hidden;text-align: left; width:auto;">
     <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="AddTreatmentData">
     <input class="button" align="right" type="button" value="Add(+)"/>
     </a>
     <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="RemoveTreatmentData">
     <input class="button" align="right" type="button" value="Remove(-)" style="background-color: #D3D3D3; color:#000000;"/>
     </a>
     </td>
     </tr>
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
    <h5 style="color: #6B6B6B; font-size: 14px;">MITIGATION EFFECTIVENESS</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">STATUS</h5>
    </th>    
    </tr>
    <?php $__currentLoopData = $TreatmentData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $TreatmentDataRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="text" name="RiskTreatmentActivity[]" id="RiskTreatmentActivity[]" value="<?php echo e($TreatmentDataRow->Activity); ?>" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <select style="width:100%;" name="RiskTreatmentOwner[]" id="RiskTreatmentOwner[]" class="DropDown"> 
      <option value="<?php echo e($TreatmentDataRow->Action_Owner_Username); ?>"><?php echo e($TreatmentDataRow->Action_Owner_Name); ?></option>
      <?php $__currentLoopData = $Users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $UsersData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($UsersData->User_Name); ?>"><?php echo e($UsersData->Name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </select>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <input style="border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-radius: 0px;" type="date" name="RiskTreatmentActionDue[]" id="RiskTreatmentActionDue[]" value="<?php echo e($TreatmentDataRow->Action_Due); ?>" />
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <select style="width:100%;" name="RiskTreatmentMitigation[]" id="RiskTreatmentMitigation[]" class="DropDown"> 
      <option value="<?php echo e($TreatmentDataRow->Mitigation_Method); ?>"><?php echo e($TreatmentDataRow->Mitigation_Method); ?></option>
      <option value="Ineffective (<25%)">Ineffective (<25%)</option>
      <option value="Fairly Effective (25%<50%)">Fairly Effective (25%<50%)</option>
      <option value="Mostly Effective (50%<75%)">Mostly Effective (50%<75%)</option>
      <option value="Effective (>75%)">Effective (>75%)</option>
     </select>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <select style="width:100%;" name="RiskTreatmentStatus[]" id="RiskTreatmentStatus[]" class="DropDown"> 
      <option value="<?php echo e($TreatmentDataRow->Status); ?>"><?php echo e($TreatmentDataRow->Status); ?></option>
      <option value="Completed">Completed</option>
      <option value="Ongoing">Ongoing</option>
      <option value="To Start">To Start</option> 
      <option value="Delay">Delay</option>
      <option value="Redirected">Redirected</option> 
     </select>
     </td>
     </tr>  
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </table>
</div>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
        <td style="border:hidden;text-align: left;"><br>
        <input class="button" align="right" type="button" value="BACK" style="width:25%; background-color: #D3D3D3; color:#000000;" onclick="location.href='RiskCreationBack?RiskId=<?php echo e($RiskId); ?>&Page=4'" />
        </td>
        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="NEXT" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
<input type="hidden" id="Division_Name" name="Division_Name"/>
<input type="hidden" id="Owner_Name" name="Owner_Name"/>
</form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php
}
if($CurrentPage == '6'){
?>
<?php $__currentLoopData = $RisksData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<form method="post" Action="RiskCreation?RiskId=<?php echo e($RiskId); ?>&Page=<?php echo e($NextPage); ?>" align="center" enctype="multipart/form-data" id="RiskDataStep_5">
<?php echo csrf_field(); ?>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;">  
    <tr>
     <td>
     <h4 style="font-size: 18px;">RISK REVIEW</h4><br>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>COMPANY:</b></label><br>
     <h5><?php echo e($data->Company_Name); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>DEPARTMENT:</b></label><br>
     <h5><?php echo e($data->Department_Name); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>DIVISION:</b></label><br>
     <h5><?php echo e($data->Division_Name); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>TYPE:</b></label><br>
     <h5><?php echo e($data->Type); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>TOPIC:</b></label><br>
     <h5><?php echo e($data->Topic); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>DESCRIPTION:</b></label><br>
     <h5><?php echo e($data->Description); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>OBJECTIVE:</b></label><br>
     <h5><?php echo e($data->Objective); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>CATEGORY:</b></label><br>
     <h5><?php echo e($data->Objective); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>SUB CATEGORY:</b></label><br>
     <h5><?php echo e($data->Sub_Category); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>OWNER:</b></label><br>
     <h5><?php echo e($data->Owner_Name); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>OWNER DIVISION:</b></label><br>
     <h5><?php echo e($data->Risk_Division_Name); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>KEY RISK INDICATORS:</b></label><br>
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
     <label for="Student"><b>ROOT CAUSE:</b></label><br>
     <h5><?php echo e($data->Root_Cause); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>IMPACT:</b></label><br>
     <h5><?php echo e($data->Impact); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>CONTROL EFFECTIVENESS:</b></label><br>
     <h5><?php echo e($data->Control_Effectiveness); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>DIVISION:</b></label><br>
     <h5><?php echo e($data->Division_Name); ?></h5>
     </td>
     </tr>
     <tr>
     <td style="border:hidden;text-align: left; width:50%;">
     <label for="Student"><b>STATUS:</b></label><br>
     <h5><?php echo e($data->Status); ?></h5>
     </td>
     </tr>
    <?php
    if($data->Status == 'Share' || $data->Status == 'Change' || $data->Status == 'Retain'){
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
    <h5 style="color: #6B6B6B; font-size: 14px;">MITIGATION METHOD</h5>
    </th>
    <th>
    <h5 style="color: #6B6B6B; font-size: 14px;">STATUS</h5>
    </th>    
    </tr>
    <?php $__currentLoopData = $TreatmentData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $TreatmentDataRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
     <h4><?php echo e($TreatmentDataRow->Mitigation_Method); ?></h4>
     </td>
     <td style="border:hidden;text-align: left; width:auto;">
     <h4><?php echo e($TreatmentDataRow->Status); ?></h4>
     </td>
     </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
     </table>
     </td>
     </tr>
     <?php
     }
    ?>
    <?php
    if($data->Status == 'Avoid'){
    ?>
    <tr>
    <td style="border:hidden;text-align: left; width:50%;">
    <a href="<?php echo e($data->File_Path); ?>" target="_blank"><?php echo e($data->File_Name); ?></a>
     </td>
     </tr>
     <?php
     }
    ?>  
</table>
<table style="width: 90%;height: auto;margin: 0px auto; border: hidden;"> 
    <tr>
        <td style="border:hidden;text-align: left;"><br>
        <input class="button" align="right" type="button" value="BACK" style="width:25%; height: 25px; background-color: #D3D3D3; color:#000000;" onclick="location.href='RiskCreationBack?RiskId=<?php echo e($RiskId); ?>&Page=5'" />
        </td>
        <td style="border:hidden;text-align: right;"><br>
        <input class="button" align="right" type="submit" value="FINISHED" style="width:25%; height: 25px;" />
        </td>
     </tr>
</table>
<br>
<input type="hidden" id="Division_Name" name="Division_Name"/>
<input type="hidden" id="Owner_Name" name="Owner_Name"/>
</form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php
}
?>
<?php /**PATH /data/RiskRegistry/resources/views/Risk/CreateRisk.blade.php ENDPATH**/ ?>