
<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/riskEvaluation.css" >
  
  <style>
          a.change {
  background-color: #4A3B94;
  border-radius: 9px;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 700;
  font-size: 14px;
  position: absolute;
  top: 89.66%;
  height:44px;
  width: 300px;
 	left: 930px;
        }
  </style>
</head>

<body style="margin-bottom:20em;">
                
  <p > Risk Creation <p>

<div class="ContainerRisk"> 

     <h3> Risk Evaluation </h3>
      
      <form method="POST" action="/submit-form4?risk_id=<?php echo e($risk_id); ?>">
        <?php echo csrf_field(); ?>
          <div class="txt1">
               <label for="brc">Existing Control</label>
              <input type="text" id="exc" name="Existing_Control">
         </div>
      
        <div class="txt2">
              <label for="con">Control Effectiveness</label>
        </div>
  
<!-- START DROPDOWN --> 
         <select name="Control_Effectiveness" id="CE">

            <option></option>
            <option value="Ineffective">Ineffective (<25%)</option>
            <option value="Fairly_Effective">Fairly Effective (25%<50%)</option>
            <option value="Mostly_Effective">Mostly Effective (50%<75%)</option>
            <option value="Effective">Effective (>75%)</option>
            <option value="N/A">N/A</option>
        </select>
        
        <div class="txt3">
              <label for="brc">Likelihood Level</label>
        </div>
               
<!-- Likelihood Level -->  
<fieldset id="group1" name="Likelihood_Level">
<label class="container">Almost Certain
  <input type="radio" name="group3" value="Almost_Certain">
  <span class="check"></span>
</label>
<label class="container">Likely
  <input type="radio" name="group3" value="Likely">
  <span class="check"></span>
</label>
<label class="container">Moderate
  <input type="radio" name="group3" value="Moderate">
  <span class="check"></span>
</label>
<label class="container">Unlikely
  <input type="radio" name="group3" value="Unlikely">
  <span class="check"></span>
</label>
<label class="container">Rare
  <input type="radio" name="group3" value="Rare">
  <span class="check"></span>
</label>
 </fieldset>

        <div class="txt4">
              <label for="im">Impact Level</label>
        </div>
        
        
<!-- Impact Level -->  
<fieldset id="group2" name="Impact_Level">
<label class="container_1">Insignificant
  <input type="radio" name="group4" value="Insignificant">
  <span class="check_1"></span>
</label>
<label class="container_1">Minor
  <input type="radio" name="group4" value="Minor">
  <span class="check_1"></span>
</label>
<label class="container_1">Moderate
  <input type="radio" name="group4" value="Moderate">
  <span class="check_1"></span>
</label>
<label class="container_1">Major
  <input type="radio" name="group4" value="Major">
  <span class="check_1"></span>
</label>
<label class="container_1">Catastrophic
  <input type="radio" name="group4" value="Catastrophic">
  <span class="check_1"></span>
</label>

<!--  Residual Risk Level --> 
        <div class="txt5">
              <label for="im">Residual Risk Level</label>
        </div>
        
        <input type="text" name="rl" id="rl" readonly>
        
<!-- Button -->
<input type="reset" class="buttonC" value="Clear">
<input type="submit" value="Next" name="submit" class="btnM">
   </fieldset>
 </div>
</form> 
<script>

$(document).ready(function(){
  $('input[type=radio][name=group3]').change(function() { 
    RiskImpact();
    
 });
 
  $('input[type=radio][name=group4]').change(function(){ 
    RiskImpact();
 });
});

function RiskImpact(){

if($('input:radio[name=group3]:checked').val() !=null && $('input:radio[name=group4]:checked').val() !=null ){
var group3 = $('input:radio[name=group3]:checked').val();
var group4 = $('input:radio[name=group4]:checked').val();


switch(group3+"_"+group4) { 
   case "Rare_Insignificant": 
    $('input:text[name=rl]').val("Low");
     break; 
  case "Rare_Minor": 
    $('input:text[name=rl]').val("Low"); 
    break; 
  case "Rare_Moderate": 
    $('input:text[name=rl]').val("Moderate"); 
    break;
  case "Rare_Major": 
    $('input:text[name=rl]').val("Moderate"); 
    break;
  case "Rare_Catastrophic": 
    $('input:text[name=rl]').val("High"); 
    break;
  case "Unlikely_Insignificant": 
    $('input:text[name=rl]').val("Low"); 
    break;
  case "Unlikely_Minor": 
    $('input:text[name=rl]').val("Low"); 
    break;
  case "Unlikely_Moderate": 
    $('input:text[name=rl]').val("Moderate"); 
    break;
  case "Unlikely_Major": 
    $('input:text[name=rl]').val("High"); 
    break;
  case "Unlikely_Catastrophic": 
    $('input:text[name=rl]').val("High"); 
    break;
  case "Moderate_Insignificant": 
    $('input:text[name=rl]').val("Low"); 
    break;
  case "Moderate_Insignificant": 
    $('input:text[name=rl]').val("Low"); 
    break;
  case "Moderate_Minor": 
    $('input:text[name=rl]').val("Moderate"); 
    break;
  case "Moderate_Moderate": 
    $('input:text[name=rl]').val("High"); 
    break;
  case "Moderate_Major": 
    $('input:text[name=rl]').val("High"); 
    break; 
  case "Moderate_Catastrophic": 
    $('input:text[name=rl]').val("Significant"); 
    break; 
  case "Likely_Insignificant": 
    $('input:text[name=rl]').val("Moderate"); 
    break; 
  case "Likely_Minor": 
    $('input:text[name=rl]').val("Moderate"); 
    break; 
  case "Likely_Moderate": 
    $('input:text[name=rl]').val("High"); 
    break;
  case "Likely_Major": 
    $('input:text[name=rl]').val("Significant"); 
    break;
  case "Likely_Catastrophic": 
    $('input:text[name=rl]').val("Significant"); 
    break; 
  case "Almost_Certain_Insignificant": 
    $('input:text[name=rl]').val("Moderate"); 
    break;
  case "Almost_Certain_Minor": 
    $('input:text[name=rl]').val("Moderate"); 
    break;
  case "Almost_Certain_Moderate": 
    $('input:text[name=rl]').val("High"); 
    break; 
  case "Almost_Certain_Major": 
    $('input:text[name=rl]').val("Significant"); 
    break; 
  case "Almost_Certain_Catastrophic": 
    $('input:text[name=rl]').val("Extreme"); 
    break;                                                      
 }
}}
</script>
      
</body>

</html> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/RiskCreation/RiskEvaluation.blade.php ENDPATH**/ ?>