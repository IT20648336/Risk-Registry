
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
 <link rel="stylesheet" href="css/RiskAnalysis.css" >
 
 
</head>

<body>

  <p> Risk Creation <p><br>
  
  <!-- Editable table -->
<div class="card">
 
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"
       <a href="#!" class="text-success"
          ><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a
      ></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
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
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
           
             
          </tr>
          <!-- This is our clonable table line -->
          <tr>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
            <td class="pt-3-half" contenteditable="true"></td>
           
                
          </tr>
              >
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Editable table -->

    
     

<script>

const $tableID = $('#table'); const $BTN = $('#export-btn'); const $EXPORT = $('#export');
  const newTr = `
  <tr class="hide">
    <td class="pt-3-half" contenteditable="true">Example</td>
    <td class="pt-3-half" contenteditable="true">Example</td>
    <td class="pt-3-half" contenteditable="true">Example</td>
    <td class="pt-3-half" contenteditable="true">Example</td>
    <td class="pt-3-half" contenteditable="true">Example</td>
    <td class="pt-3-half">
      <span class="table-up"
        ><a href="#!" class="indigo-text"
          ><i class="fas fa-long-arrow-alt-up" aria-hidden="true"></i></a
      ></span>
      <span class="table-down"
        ><a href="#!" class="indigo-text"
          ><i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i></a
      ></span>
    </td>
    <td>
      <span class="table-remove"
        ><button
          type="button"
          class="btn btn-danger btn-rounded btn-sm my-0 waves-effect waves-light"
        >
          Remove
        </button></span
      >
    </td>
  </tr>
  `;
  $('.table-add').on('click', 'i', () => {
    const $clone = $tableID.find('tbody
        tr ').last().clone(true).removeClass('
        hide table - line '); if ($tableID.find('
        tbody tr ').length ===
        0) {
        $('tbody').append(newTr);
    }
    $tableID.find('table').append($clone);
});
$tableID.on('click', '.table-remove', function() {
    $(this).parents('tr').detach();
});
$tableID.on('click', '.table-up', function() {
    const $row = $(this).parents('tr');
    if ($row.index() === 0) {
        return;
    }
    $row.prev().before($row.get(0));
});
$tableID.on('click',
    '.table-down',
    function() {
        const $row = $(this).parents('tr');
        $row.next().after($row.get(0));
    }); // A few jQuery helpers for exporting only jQuery.fn.pop
= [].pop;
jQuery.fn.shift = [].shift;
$BTN.on('click', () => {
    const $rows =
        $tableID.find('tr:not(:hidden)');
    const headers = [];
    const data = []; // Get the headers
    (add special header logic here) $($rows.shift()).find('th:not(:empty)').each(function() {
        headers.push($(this).text().toLowerCase());
    }); // Turn all existing rows into a loopable
    array $rows.each(function() {
        const $td = $(this).find('td');
        const h = {}; // Use the
        headers from earlier to name our hash keys headers.forEach((header, i) => {
            h[header] =
                $td.eq(i).text();
        });
        data.push(h);
    }); // Output the result
    $EXPORT.text(JSON.stringify(data));
});
</script>

<div class="ContainerRisk"> 

     <h3> Risk Analysis </h3>
      
     <form action="RiskEvaluation" method="POST">
     <?php echo csrf_field(); ?>
     
     <div class="txt2">
     <label for="Risk_Description">Root Cause:</label><br><br>
     <textarea id="RD" name="Risk_Description" rows="4" cols="70"> </textarea>
      </div>
      
      <div class="txt1">
     <label for="Risk_Description">Impact :</label><br><br>
     <textarea id="RD" name="Risk_Description" rows="4" cols="70"> </textarea>
      </div>
         
      <div class="txt3">
              <label for="im">Likelihood_Level</label>
        </div>          
<!-- Likelihood Level -->  
<fieldset id="group1" name="Likelihood_Level">
<label class="container">Almost Certain
  <input type="radio" name="group1" value="Almost_Certain">
  <span class="check"></span>
</label>
<label class="container">Likely
  <input type="radio" name="group1" value="Likely">
  <span class="check"></span>
</label>
<label class="container">Moderate
  <input type="radio" name="group1" value="Moderate">
  <span class="check"></span>
</label>
<label class="container">Unlikely
  <input type="radio" name="group1" value="Unlikely">
  <span class="check"></span>
</label>
<label class="container">Rare
  <input type="radio" name="group1" value="Rare">
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
              <label for="im">Residual Risk Level</label>
        </div>
        
        <input type="text" name="rl" id="rl" readonly>
        
<!-- Button -->
<button class="button" >Next</button>
<input type="reset" class="buttonC" value="Clear">

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


 </fieldset>
</div>
</body>
</html> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('NavBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views//RiskCreation/RiskAnalysis.blade.php ENDPATH**/ ?>