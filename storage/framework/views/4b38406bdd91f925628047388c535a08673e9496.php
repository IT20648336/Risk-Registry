<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
<script src="js/main.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="js/Internal.js"></script>
<script type="text/javascript" src="js/chart.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script type="text/javascript" src="js/Chart1.min.js"></script>
<script type="text/javascript" src="js/script.min.js"></script>
</head>
<body>
<div class="wrapper d-flex align-items-stretch"  style="background-color: #FFFFFF;">
<nav id="sidebar">
<div class="p-4 pt-5">
<div align="center" class="ProfileImage"> 
<img border="2" style="border: none; width:auto; height:110px;background-color: white; border-radius: 5%;max-width:80%;max-height:60%;" src="/images/Logo_Final.png"/>
</div>
<div class="ProfileName">
    <br>
</div>
<ul class="list-unstyled components mb-5"> 
<li>
<a href="/Dashboard"><img  id="Logout" src="/images/Dashboard.png"/> &nbsp;&nbsp;DASHBOARD</a>
</li>

<li>
<a href="#pageSubmenu5" data-toggle="collapse" aria-expanded="false" id="DropDownArrow2" name="DropDownArrow2"class="dropdown-toggle">
    <img  id="Logout" src="/images/Risk_Icon.png"/> &nbsp;&nbsp;&nbsp;MY RISKS&nbsp;&nbsp;&nbsp;<img id="DropDownImage2" name="DropDownImage2" width="10" height="7" src="/images/DropDown.png"></a>
<ul class="collapse list-unstyled" id="pageSubmenu5">
<li>
    <a href="/CreateRisk?RiskId=0">CREATE</a> 
</li>
<li>
    <a href="/MyRisks">CREATED</a>
    
</li>  
<li>
    <a href="/AssignedRisks">ASSIGNED</a>
</li> 
</ul>
</li>
<ul class="list-unstyled components mb-5"> 
<li>
<a href="#pageSubmenu20" data-toggle="collapse" aria-expanded="false" id="DropDownArrow3" name="DropDownArrow3" class="dropdown-toggle">
    <img  id="Logout" src="/images/Approvals.png"/> &nbsp;&nbsp;&nbsp;APPROVALS&nbsp;&nbsp;&nbsp;<img name="DropDownImage3" id="DropDownImage3" width="10" height="7" src="/images/DropDown.png"></a>
<ul class="collapse list-unstyled" id="pageSubmenu20">
<li>
    <a href="/Pending ">PENDING</a> 
</li>
<li>
    <a href="/Completed ">COMPLETED</a>
</li>                                          
</ul>
</li>

<?php if(Session::get('Role') == 'Admin' || Session::get('Role') == 'Root'): ?> 
<li>
<a href="/AllRisks"><img  id="Logout" src="/images/AllRisks.png"/> &nbsp;&nbsp;ALL RISKS</a>
</li> 
<li>
<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" id="DropDownArrow4" name="DropDownArrow4"class="dropdown-toggle">
    <img  id="Logout" src="/images/Admin.png"/> &nbsp;&nbsp;&nbsp;ADMIN FUNCTIONS&nbsp;&nbsp;&nbsp;<img name="DropDownImage4" id="DropDownImage4" width="10" height="7" src="/images/DropDown.png"></a>
<ul class="collapse list-unstyled" id="pageSubmenu">
        <li>
            <a href="/UserData">USERS</a>
        </li>
        <li>
            <a href="/NewRisks">NEW RISKS</a>
        </li>
        <li>
            <a href="/ClosedRisks">CLOSED RISKS</a>
        </li>
        <li>
            <a href="/NotAttendedRisks">NOT ATTENDED RISKS</a>
        </li>
        <li>
            <a href="/Reminders">REMINDERS</a>
        </li>
         <li>
            <a href="/categories">RISK CATEGORY</a>
        </li>
</ul>
</li>
<li>

<a href="#pageSubmenu11" data-toggle="collapse" aria-expanded="false" id="DropDownArrow1" name="DropDownArrow1" class="dropdown-toggle">
<img  id="Logout" src="/images/Company.png"/> &nbsp;&nbsp;&nbsp;HIERARCHY&nbsp;&nbsp;&nbsp;<img id="DropDownImage1" name="DropDownImage1" width="10" height="7" src="/images/DropDown.png"/></a>
<ul class="collapse list-unstyled" id="pageSubmenu11">
        <li>
            <a href="/Departments">DEPARTMENTS</a>
        </li>
        <li>
            <a href="/Divisions">DIVISIONS</a>
        </li>                                  
</ul>
</li>
<li>

<a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" id="DropDownArrow5" name="DropDownArrow5" class="dropdown-toggle">
    <img  id="Logout" src="/images/Email_White.png"/> &nbsp;&nbsp;&nbsp;E-MAILS&nbsp;&nbsp;&nbsp;<img name="DropDownImage5" id="DropDownImage5" width="10" height="7" src="/images/DropDown.png"> </a>
<ul class="collapse list-unstyled" id="pageSubmenu2">
       
        <li>
            <a href="/SentItems">SENT ITEMS</a>
        </li> 
        <!--<li>
            <a href="/MailTemplates">MAIL TEMPLATES</a>
        </li> -->                                   
</ul>
</li>
<li>
    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" id="DropDownArrow6" name="DropDownArrow6" class="dropdown-toggle"><img  id="Logout" src="/images/Logs.png"/> &nbsp;&nbsp;&nbsp;LOGS&nbsp;&nbsp;&nbsp;<img name="DropDownImage6" id="DropDownImage6" width="10" height="7" src="/images/DropDown.png"> </a>
<ul class="collapse list-unstyled" id="pageSubmenu1">
<li>
<a href="/ActivityLogs">ACTIVITY LOGS</a>
</li>
<li>
<a href="/ErrorLogs">ERROR LOGS</a>
</li>
</ul>
</li>
<?php endif; ?>
<li>
<a href="Logout"><img  id="Logout" src="/images/Exit.png"/> &nbsp;&nbsp;&nbsp;EXIT</a>
</li>
</ul>
<div class="footer2">
<p>&copy; 2023&nbsp;&nbsp;Dialog Axiata PLC&nbsp;&nbsp;Powered By Network Analytics and Automation Support - Group Technology&nbsp;&nbsp;|&nbsp;&nbsp;Version 1.0
</p>
</div>
</div>
</nav>
<script>
$(document).ready(function() {
  $("#DropDownArrow1").click(function() {
    $("#DropDownImage1").toggleClass('rotate-180');
  });
});
$(document).ready(function() {
  $("#DropDownArrow2").click(function() {
    $("#DropDownImage2").toggleClass('rotate-180');
  });
});
$(document).ready(function() {
  $("#DropDownArrow3").click(function() {
    $("#DropDownImage3").toggleClass('rotate-180');
  });
});
$(document).ready(function() {
  $("#DropDownArrow4").click(function() {
    $("#DropDownImage4").toggleClass('rotate-180');
  });
});
$(document).ready(function() {
  $("#DropDownArrow5").click(function() {
    $("#DropDownImage5").toggleClass('rotate-180');
  });
});
$(document).ready(function() {
  $("#DropDownArrow6").click(function() {
    $("#DropDownImage6").toggleClass('rotate-180');
  });
});
</script>
  
  
  
  <div id="content" class="p-4 p-md-5">
  
</body>  
  
 </html> 
  
  
  
  

<?php /**PATH /data/RiskRegistry/resources/views/layouts/header.blade.php ENDPATH**/ ?>