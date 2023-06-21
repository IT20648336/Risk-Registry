

<html>
<head>
<style>
.multiselect {
 width:200px;
}
.selectBox {
 position:relative;
}
.selectBox select {
 width: 100%;
 font-weight: bold;
}
.overSelect {
 position: absolute;
 left:0; right:0; top:0; bottom:0;
}
#checkboxes {
 display: none;
 border: 1px #dadada solid;
}
#checkboxes label {
 display: block;
}
#checkboxes label:hover {
 background-color: #1e90ff;
}
</style>
</head>
<body>
<form>
 <div class="multiselect">
  <div class="selectBox" onclick="showCheckboxes()">
   <select>
    <option>Select and Option</option>
   </select>
   <div class="overSelect"></div>
  </div>
  <div id="checkboxes">
   <label><input type="checkbox" id="1"/>One</label>
   <label><input type="checkbox" id="2"/>Two</label>
   <label><input type="checkbox" id="3"/>Three</label>
  </div>
 </div>
</form>
</body>

<script>
var expanded = false;
function showCheckboxes()
{
 var checkboxes = document.getElementById("checkboxes");
 if(!expanded)
 {
  checkboxes.style.display = "block";
  expanded = true;
 }
 else
 {
  checkboxes.style.display = "none";
  expanded = false;
 }
}

</script>
</html><?php /**PATH /data/RiskRegistry/resources/views/Demo.blade.php ENDPATH**/ ?>