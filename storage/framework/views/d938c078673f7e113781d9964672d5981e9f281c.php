<!DOCTYPE html>
<html>
<head>
  <title>LOG IN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/Main.css" >
  <link rel="shortcut icon" href="/images/dialog_logo.png"/>
  <link rel="stylesheet" href="/css/sweetalert.css" >
  <link rel="javascript" href="js/sweetalert.js" >
  
  
<style>
  body {
    background-image: url('/images/Login.png') ;  //form logo
  background-color: #FFFFFF;
  background-position: initial ;
  //background-position: center;
  background-repeat: no-repeat;
  background-size: 800px 800px;
  //position: relative;
  //margin-left: auto;
  //margin-right: auto;
  </style>

   
</head>
<body>


<?php if(Session::get('success')): ?>
                 <div class="alert alert-danger">
                     <?php echo e(Session::get('success')); ?>

                 </div>
                <?php endif; ?>
                <?php if(Session::get('fail')): ?>
                <div class="alert alert-success">
                     <?php echo e(Session::get('fail')); ?>

                 </div>
                <?php endif; ?>



  <form action="Login" method = "POST">
  <?php echo csrf_field(); ?>

      <div class="ContainerLogin"> 
      <div class="logo">
      <br>
    <img src="/images/Dlogo.png" style="width:auto;height:100px;" align="center">
  </div>
  <div class="ContainerHeaderLogin">
      <b>&nbsp;</b>
      <div class="Login_Page_Theme">
    
  </div>
      
    </div>
  <div class="Login_Page_Theme">
  </div>
  
  <div class="login__field">
    <i class="login__icon fas fa-user"></i>
    <label for="username">USER_NAME /EMAIL</label>
    <input type="text" >
    <span style="color:red"><?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
  </div>
  
  <div class="login__field">
  <i class="login__icon fas fa-lock"></i>
    <label for="password">PASSWORD</label>
    <input type="password" >
   
  </div>
  
   <br><br>
  
  
  <div class="footer">
    <p>
    &copy; 2023&nbsp;&nbsp;Dialog Axiata PLC&nbsp;&nbsp; Powered By Network Analytics and Automation Support - Group Technology&nbsp;&nbsp;|&nbsp;&nbsp;Version 1.0
    </p>
  </div>
  
  
  
 <input style="width: 90%; background:#342D7E; color: #FFFFFF; border-radius: 20px; padding: 0px 0px 0px 0px;margin-top: 10px; font-weight: bold;" type="submit" onclick="check(this.form)" value="SIGN IN" name="submit">

 
  <br><br>
  
 
  
  <br>
  
  </div>
  
  </form>
  

  
</body>



</html><?php /**PATH /data/RiskRegistry/resources/views/LoginNew.blade.php ENDPATH**/ ?>