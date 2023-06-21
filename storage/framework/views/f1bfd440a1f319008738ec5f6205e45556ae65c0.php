
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 
 <link rel="stylesheet" href="css/RiskReview.css" >
 
 
</head>

<body>

  <p> Risk Creation </p><br>
  

<div class="ContainerRisk"> 

     
      
     <form action="RiskEvaluation" method="POST">
     <?php echo csrf_field(); ?>
<div class="Data">
<?php $__currentLoopData = $Data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

  <tr1>Portfolio Selection:</tr1><br>
  <tr> <?php echo e($user['Portfolio']); ?> </tr><br>
  
 <tr1>Risk Topic:</tr1><br> 
  <tr> <?php echo e($user['Risk_Topic']); ?> </tr><br>
  
  <tr1>Risk Description:</tr1><br>
  <tr><?php echo e($user['Risk_Description']); ?> </tr><br>
  
  <tr1>High level business objective:</tr1><br> 
  <tr> <?php echo e($user['HighLevel_BO']); ?> </tr><br>
  
<tr1>Risk Category:</tr1><br>
 <tr> <?php echo e($user['Risk_Category']); ?> </tr><br>
  
 <tr1>Sub Risk Category:</tr1><br>
 <tr> <?php echo e($user['SubRisk_Category']); ?></tr>
   <br>
 <tr1>Risk Owner:</tr1><br>
 <tr> <?php echo e($user['Risk_Owner']); ?> </tr><br>
   
<tr1>Risk Division:</tr1><br>
 <tr> <?php echo e($user['Risk_Division']); ?> </tr> <br><br>
  
<table border = "1">
<tr1>
<td>Key Risk Indicators (KRIs)</td>
<td>Current Status</td>
<td>Risk Tolerance</td>
<td>Risk Appetite</td>
<td>Risk Threshold</td>
</tr1>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = $Risk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td><?php echo e($user['KRI']); ?></td>
<td><?php echo e($user['Current_Status']); ?></td>
<td><?php echo e($user['Risk_Tolerance']); ?></td>
<td><?php echo e($user['Risk_Appetite']); ?></td>
<td><?php echo e($user['Risk_Threshold']); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table><br>
<?php $__currentLoopData = $Data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr1>Root Cause:</tr1><br>
  <tr> <?php echo e($user['Root_Cause']); ?> </tr><br>
  
 <tr1>Impact:</tr1><br>
  <tr> <?php echo e($user['Impact']); ?> </tr><br>
  
 <tr1>Likelihood Level:</tr1><br>
  <tr> <?php echo e($user['Likelihood_Level1']); ?> </tr><br>
  
 <tr1>Impact Level:</tr1><br>
  <tr> <?php echo e($user['Impact_Level1']); ?> </tr><br>
  
 <tr1>Gross RiskLevel:</tr1><br>
  <tr> <?php echo e($user['GrossRisk_Level']); ?> </tr><br>
  
  <tr1>Existing Control:</tr1><br>
  <tr> <?php echo e($user['Existing_Control']); ?> </tr><br>
  
 <tr1>Control Effectiveness:</tr1><br>
  <tr> <?php echo e($user['Control_Effectiveness']); ?> </tr><br>
  
  <tr1>Likelihood Level:</tr1><br>
  <tr> <?php echo e($user['Likelihood_Level2']); ?> </tr><br>
  
  <tr1>Impact Level:</tr1><br>
  <tr> <?php echo e($user['Impact_Level2']); ?> </tr><br>
  
  <tr1>Residual RiskLevel:</tr1><br>
  <tr> <?php echo e($user['ResidualRisk_Level']); ?> </tr><br>
  
  
  
       
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<button type="submit" class="button" value="Next" >CREATE THE RISK</button>

 </fieldset>
</div>
</body>
</html> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views//RiskCreation/RiskReview.blade.php ENDPATH**/ ?>