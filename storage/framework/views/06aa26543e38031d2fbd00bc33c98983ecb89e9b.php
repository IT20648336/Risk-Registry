<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="/images/Ico_Black.ico"/>
<link href="css/GoogleFont.css" rel="stylesheet">		
<link rel="stylesheet" href="css/Main.css">
<link rel="stylesheet" href="css/sweetalert.css">
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">

<script type="text/javascript" src="js/sweetalert.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/Main.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="js/function.js"></script>

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
   position: fixed;
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

<?php
// <div class="loader" ><img src="http://10.56.48.110/TNP360/Icons/fb.gif"></div>
?>

<div class="sidenav">
<div align="center" class="ProfileImage"> 
<nav id="sidebar" style="background: url("/images/Dlogo.png") repeat-y; background-color: yellow;">
<img border="2" style="border: none; width:118px; height:110px;" src="/images/Dlogo.png"/>
</div>
<div class="ProfileName">
<p align="center"><font color="white">
Risk Management System
</font>

</p>
</div><br><br>


  <a href="#DASHBOARD"><img id="Logout" src="/images/NavBar icons/dashboard.png"/>  &nbsp;&nbsp;Dashboard</a>
  <a href="#HOME"><img  id="Logout" src="/images/NavBar icons/home.png"/> &nbsp;&nbsp;&nbsp;Home</a>
 
  
  <button class="dropdown-btn"><img  id="Logout" src="/images/NavBar icons/company.png"/> &nbsp;&nbsp;&nbsp;New
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/CompanyN">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company</a>
    <a href="/Department">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department</a>
       <a href="/Department">&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;Division</a>
  </div>

  <button class="dropdown-btn"><img  id="Logout" src="/images/NavBar icons/user.png"/> &nbsp;&nbsp;&nbsp;Admin Functions
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/UserCreation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add User</a>
    <a href="/Manage-User">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manage User</a>
  </div>
  

  
  <button class="dropdown-btn"><img  id="Logout" src="/images/NavBar icons/my_risk.png"/> &nbsp;&nbsp;&nbsp;My Risks
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="/PortfolioSelection">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create Risks</a>
    <a href="/">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Created Risks</a>
       <a href="/">&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;Risk Drafts</a>
        <a href="/">&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;Tagged Risks</a>
  </div>
  
  <a href="#ALL RISKS"><img  id="Logout" src="/images/NavBar icons/risk.png"/> &nbsp;&nbsp;&nbsp;All Risks</a>
  <a href="#EXIT"><img  id="Logout" src="/images/NavBar icons/exit.png"/> &nbsp;&nbsp;&nbsp;Exit</a>
  
  <br><br><br>
 <div class="footer2">
<p><br><br><br><br><br><br>
&copy; 2023 &nbsp;&nbsp;Dialog Axiata PLC&nbsp;&nbsp; Powered By Network Analytics and Automation Support - Group Technology&nbsp;&nbsp;|&nbsp;&nbsp;Version 1.0
</p>
</div></font>
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
</nav>

  <div id="content" class="p-4 p-md-5">
  <?php echo $__env->yieldContent('content'); ?><?php /**PATH /data/RiskRegistry/resources/views/Nav.blade.php ENDPATH**/ ?>