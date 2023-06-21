
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
 
 <link rel="stylesheet" href="css/newcss.css" >
 
 
</head>

<body>
  <p> Risk Creation <p><br>
  
<div class="ContainerRisk"> 

      <form method="POST" action="/submit-form3?risk_id=<?php echo e($risk_id); ?>">
     <?php echo csrf_field(); ?>
     
     <h3> Risk Analysis </h3> 
     <!-- Editable table -->
<div class="card">
 
  <div class="card-body">
  
 <a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="Add_Risk_Analysis">
<button type="button" class="button4">Row &nbsp;&nbsp;<img  id="Logout" src="/images/plus.png"/></button>
</a>
<a style="font-family:Calibri; text-decoration: none;" href="#" title="" class="Remove_Risk_Analysis">
<button type="button" class="button7">Row &nbsp;&nbsp;<img  id="Logout" src="/images/minus.png"/></button>
</a><br><br>
      <table class="Add_Risk_Analysis-List" id="Risk_Analysis">
        <thead>
          <tr>
            <th class="text-center">Key Risk Indicators (KRIs)</th>
            <th class="text-center">Current Status</th>
            <th class="text-center">Risk Tolerance</th>
            <th class="text-center">Risk Appetite</th>
            <th class="text-center">Risk Threshold</th>
          </tr>
        </thead>
        <tbody>
 

          <tr>
            <td class="pt-3-half"><input style="width:auto;" type="text" name="KRI[]" id="KRI[]" ></td>
            <td class="pt-3-half"><input style="width:auto;" type="text" name="Current_Status[]" id="Current_Status[]" ></td>
            <td class="pt-3-half"><input style="width:auto;" type="text" name="Risk_Tolerance[]" id="Risk_Tolerance[]" ></td>
            <td class="pt-3-half"><input style="width:auto;" type="text" name="Risk_Appetite[]" id="Risk_Appetite[]" ></td>
            <td class="pt-3-half"><input style="width:auto;" type="text" name="Risk_Threshold[]" id="Risk_Threshold[]" ></td>          
          </tr>

        </tbody>
      </table>

  </div>
</div><br><br><br>

     <div class="txt2">
     <label for="Root_Cause">Root Cause:</label>
     <textarea id="RD" name="Root_Cause" rows="4" cols="70"> </textarea>
      </div><br>
      
      <div class="txt1">
     <label for="Impact">Impact :</label>
     <textarea id="RD" name="Impact" rows="4" cols="70"> </textarea>
      </div>
         
      <div class="txt3">
              <label for="im">Likelihood Level</label>
        </div>          
<!-- Likelihood Level -->  
<fieldset id="group1" name="Likelihood_Level">
<label class="container">Rare
  <input type="radio" name="group1" value="Rare">
  <span class="check"></span>
</label>
<label class="container">Unlikely
  <input type="radio" name="group1" value="Unlikely">
  <span class="check"></span>
</label>
<label class="container">Moderate
  <input type="radio" name="group1" value="Moderate">
  <span class="check"></span>
</label>
<label class="container">Likely
  <input type="radio" name="group1" value="Likely">
  <span class="check"></span>
</label>
<label class="container">Almost Certain
  <input type="radio" name="group1" value="Almost_Certain">
  <span class="check"></span>
</label>
 </fieldset>

        <div class="txt4">
              <label for="im">Impact Level</label>
        </div>
        
        
<!-- Impact Level -->  
<fieldset id="group2" name="Impact_Level">
<label class="container_1">Insignificant
  <input type="radio" name="group2" value="Insignificant">
  <span class="check_1"></span>
</label>
<label class="container_1">Minor
  <input type="radio" name="group2" value="Minor">
  <span class="check_1"></span>
</label>
<label class="container_1">Moderate
  <input type="radio" name="group2" value="Moderate">
  <span class="check_1"></span>
</label>
<label class="container_1">Major
  <input type="radio" name="group2" value="Major">
  <span class="check_1"></span>
</label>
<label class="container_1">Catastrophic
  <input type="radio" name="group2" value="Catastrophic">
  <span class="check_1"></span>
</label>

<!--  Residual Risk Level --> 
        <div class="txt5">
              <label for="GrossRisk_Level">Gross Risk Level</label>
        </div>
        
        <input type="text" name="GrossRisk_Level" id="rl" readonly>
      
<!-- Button -->
<br>
<input type="reset" class="buttonC" value="Clear"><br>

<input type="submit" value="Next" name="submit" class="btnM"> 
   </fieldset>
 </div>
</form> 



<script>

$(document).ready(function(){
  $('input[type=radio][name=group1]').change(function() { 
    RiskImpact();
    
 });
 
  $('input[type=radio][name=group2]').change(function(){ 
    RiskImpact();
 });
});

function RiskImpact(){

if($('input:radio[name=group1]:checked').val() !=null && $('input:radio[name=group2]:checked').val() !=null ){
var group1 = $('input:radio[name=group1]:checked').val();
var group2 = $('input:radio[name=group2]:checked').val();


switch(group1+"_"+group2) { 
   case "Rare_Insignificant": 
    $('input:text[name=GrossRisk_Level]').val("Low");
     break; 
  case "Rare_Minor": 
    $('input:text[name=GrossRisk_Level]').val("Low"); 
    break; 
  case "Rare_Moderate": 
    $('input:text[name=GrossRisk_Level]').val("Moderate"); 
    break;
  case "Rare_Major": 
    $('input:text[name=GrossRisk_Level]').val("Moderate"); 
    break;
  case "Rare_Catastrophic": 
    $('input:text[name=GrossRisk_Level]').val("High"); 
    break;
  case "Unlikely_Insignificant": 
    $('input:text[name=GrossRisk_Level]').val("Low"); 
    break;
  case "Unlikely_Minor": 
    $('input:text[name=GrossRisk_Level]').val("Low"); 
    break;
  case "Unlikely_Moderate": 
    $('input:text[name=GrossRisk_Level]').val("Moderate"); 
    break;
  case "Unlikely_Major": 
    $('input:text[name=GrossRisk_Level]').val("High"); 
    break;
  case "Unlikely_Catastrophic": 
    $('input:text[name=GrossRisk_Level]').val("High"); 
    break;
  case "Moderate_Insignificant": 
    $('input:text[name=GrossRisk_Level]').val("Low"); 
    break;
  case "Moderate_Insignificant": 
    $('input:text[name=GrossRisk_Level]').val("Low"); 
    break;
  case "Moderate_Minor": 
    $('input:text[name=GrossRisk_Level]').val("Moderate"); 
    break;
  case "Moderate_Moderate": 
    $('input:text[name=GrossRisk_Level]').val("High"); 
    break;
  case "Moderate_Major": 
    $('input:text[name=GrossRisk_Level]').val("High"); 
    break; 
  case "Moderate_Catastrophic": 
    $('input:text[name=GrossRisk_Level]').val("Significant"); 
    break; 
  case "Likely_Insignificant": 
    $('input:text[name=GrossRisk_Level]').val("Moderate"); 
    break; 
  case "Likely_Minor": 
    $('input:text[name=GrossRisk_Level]').val("Moderate"); 
    break; 
  case "Likely_Moderate": 
    $('input:text[name=GrossRisk_Level]').val("High"); 
    break;
  case "Likely_Major": 
    $('input:text[name=GrossRisk_Level]').val("Significant"); 
    break;
  case "Likely_Catastrophic": 
    $('input:text[name=GrossRisk_Level]').val("Significant"); 
    break; 
  case "Almost_Certain_Insignificant": 
    $('input:text[name=GrossRisk_Level]').val("Moderate"); 
    break;
  case "Almost_Certain_Minor": 
    $('input:text[name=GrossRisk_Level]').val("Moderate"); 
    break;
  case "Almost_Certain_Moderate": 
    $('input:text[name=GrossRisk_Level]').val("High"); 
    break; 
  case "Almost_Certain_Major": 
    $('input:text[name=GrossRisk_Level]').val("Significant"); 
    break; 
  case "Almost_Certain_Catastrophic": 
    $('input:text[name=GrossRisk_Level]').val("Extreme"); 
    break;                                                      
 }
}}
</script>
<script>
jQuery(function (){
    var counter = 1;
    jQuery('a.Add_Risk_Analysis').click(function(event){
        event.preventDefault();

var newRow = jQuery('<tr><td class="pt-3-half"><input Style="width: auto;" name="KRI[]" type="text" id="KRI[]" required></td><td class="pt-3-half"><input Style="width: auto;" name="Current_Status[]" type="text" id="Current_Status[]" required></td><td class="pt-3-half"><input Style="width: auto;" name="Risk_Tolerance[]" type="text" id="Risk_Tolerance[]" required></td><td class="pt-3-half"><input Style="width: auto;" name="Risk_Appetite[]" type="text" id="Risk_Appetite[]" required></td>\n\
<td class="pt-3-half"><input Style="width: auto;" name="Risk_Threshold[]" type="text" id="Risk_Threshold[]" required></td></tr>');
            counter++;
if (counter > 50) return;
        jQuery('table.Add_Risk_Analysis-List').append(newRow);

    });
});

jQuery(function (){

    jQuery('a.Remove_Risk_Analysis').click(function(event){
        event.preventDefault();
        $('#Risk_Analysis tr:last').remove();

    });
});
</script>
</div>
</div>
</body>
</html> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/RiskCreation/RiskAnalysis.blade.php ENDPATH**/ ?>