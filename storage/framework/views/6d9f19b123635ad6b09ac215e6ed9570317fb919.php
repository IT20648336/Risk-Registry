<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: "Lato", sans-serif;
}



/* Fixed sidenav, full height */
.sidenav {
  height: 100%;
  width: 250px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #4A3B94;
 overflow-x: hidden;
  padding-top: 20px;
  font-family:open sans ;
 
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 15px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
  font-family:open sans ;
   font-color:#FBFCF8;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: #342D7E;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: #342D7E;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>



//NAV BAR
<div class="sidenav">
<div align="center" class="ProfileImage"> 
<img border="2" style="border: none; width:118px; height:110px;" src="/images/Dlogo.png"/>
</div>
<div class="ProfileName">
<p align="center"><font color="white">
Risk Management System
</font>

</p>
</div><br><br>


  <a href="#DASHBOARD">DASHBOARD</a><br>
  <a href="#HOME">HOME</a><br>
 
  
  <button class="dropdown-btn">NEW
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/CompanyN">COMPANY</a>
    <a href="/Department">DEPARTMENT</a>
       <a href="/Department">DIVISION</a>
  </div>
 <br>
  <button class="dropdown-btn">ADMIN FUNCTIONS 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/UserCreation">Add User</a>
    <a href="/Manage-User">Manage User</a>
  </div>
  <br>
  <a href="#MY RISKS">MY RISKS</a><br>
  <a href="#ALL RISKS">ALL RISKS</a><br>
  <a href="#EXIT">EXIT</a>
  
  <br><br><br>
  <p style="font-family:open sans;color:white; font-size:12px ;align ="center"">
&copy; 2023 &nbsp;&nbsp;Dialog Axiata PLC&nbsp;&nbsp; Powered By Network Analytics and Automation Support - Group Technology&nbsp;&nbsp;|&nbsp;&nbsp;Version 1.0
</p></font>
</div>




<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
} 
</script>



</body>
</html> 
<?php echo $__env->yieldContent('content'); ?><?php /**PATH /data/RiskRegistry/resources/views/NavBarN.blade.php ENDPATH**/ ?>