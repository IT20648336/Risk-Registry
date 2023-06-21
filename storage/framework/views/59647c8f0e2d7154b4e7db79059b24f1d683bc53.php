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

</head>
<body>

<?php
// <div class="loader" ><img src="http://10.56.48.110/TNP360/Icons/fb.gif"></div>
?>

<div class="wrapper d-flex align-items-stretch"  style="height:800px;">
<nav id="sidebar" style="background: url("/images/Dlogo.png") repeat-y; background-color: yellow;">
<div class="p-4 pt-5">
<div align="center" class="ProfileImage"> 
<img border="2" style="border: none; width:118px; height:110px;" src="/images/Dlogo.png"/>
</div>
<div class="ProfileName">
<p>

Risk Management System
</p>
</div><br><br>
<ul class="list-unstyled components mb-5"> 
<li>
<a href="/Dashboard"><img id="Logout" src="/images/NavBar icons/dashboard.png"/>  &nbsp;&nbsp;DASHBOARD</a>
</li>

<li>
<a href="HOME" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
<img  id="Logout" src="/images/NavBar icons/home.png"/> &nbsp;&nbsp;&nbsp;HOME</a>
<ul class="collapse list-unstyled" id="pageSubmenu5">
<li>
    <a href="/SiteData">SITE</a> 
</li>
<li>
    <a href="#"></a>
</li>                                           
</ul>
</li>
<li>
<a href="NEW" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
<img  id="Logout" src="/images/NavBar icons/company.png"/> &nbsp;&nbsp;&nbsp;NEW</a>
<ul class="collapse list-unstyled" id="pageSubmenu">
        <li>
            <a href="/CompanyN">COMPANY</a>
        </li>
        
        <li>
            <a href="#">DEPARTMENT</a>
        </li>
        <li>
            <a href="#">DIVISION</a>
        </li>
</ul>
</li>

<li>
<a href="MY RISKS" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
<img  id="Logout" src="/images/NavBar icons/my_risk.png"/> &nbsp;&nbsp;&nbsp;MY RISKS</a>
<ul class="collapse list-unstyled" id="pageSubmenu11">
        <li>
            <a href="/GridPower"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>                                   
</ul>
</li>

<li>
<a href="ALL RISKS" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
<img  id="Logout" src="/images/NavBar icons/risk.png"/> &nbsp;&nbsp;&nbsp;ALL RISKS</a>
<ul class="collapse list-unstyled" id="pageSubmenu11">
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>
        <li>
            <a href="#"></a>
        </li>                                   
</ul>
</li>

<li>
<a href="Logout"><img  id="Logout" src="/images/NavBar icons/exit.png"/> &nbsp;&nbsp;&nbsp;EXIT</a>
</li>
</ul>
<div class="footer2">
<p><br><br><br><br><br><br>
&copy; 2023 &nbsp;&nbsp;Dialog Axiata PLC&nbsp;&nbsp; Powered By Network Analytics and Automation Support - Group Technology&nbsp;&nbsp;|&nbsp;&nbsp;Version 1.0
</p>
</div>
</div>
</nav>
  <div id="content" class="p-4 p-md-5">
  <?php echo $__env->yieldContent('content'); ?><?php /**PATH /data/RiskRegistry/resources/views/NavBar.blade.php ENDPATH**/ ?>