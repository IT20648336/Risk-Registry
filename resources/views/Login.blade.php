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
    background-image: url('/images/Login.png');
  background-color: #FFFFFF;
  background-position: initial;
  background-repeat: no-repeat;
  background-size: 800px 800px;
  </style>
</head>
<body>
  <form action="Login" method = "POST">
  @csrf
<div class="ContainerLogin"> 
<div class="logo">
<br>
<img src="/images/Risk_Compas_img.png" style="width:auto;height:150px;" align="center">
</div>
<div class="ContainerHeaderLogin">
<div class="Login_Page_Theme">
</div>   
</div>
<div class="Login_Page_Theme">
</div>
  
<div class="login__field">
  <i class="login__icon fas fa-user"></i>
  <input type="text" name="username" style="padding: 0px; background: none; border: none; border-bottom: 1px solid #007489; transition: .2s; border-radius: 0px; display: inline-block; width: 80%;" placeholder="Username">
  <span style="color:red;">@error('username'){{$message}}@enderror</span>
</div>

<div class="login__field">
  <i class="login__icon fas fa-lock"></i>
  <input type="password" name="password" style="padding: 0px; background: none; border: none; border-bottom: 1px solid #007489; transition: .2s; border-radius: 0px; display: inline-block; width: 80%;" placeholder="Password">
  <span class="toggle-password" style="margin-left: -5%;" onclick="togglePasswordVisibility(this)"> &#x1f441; </span>
</div>

<input style="width: 80%; background: #342D7E; color: #FFFFFF; border: 1px solid #342D7E;padding: 0px 0px 0px 0px;margin-top: 10px; font-weight: bold;" type="submit" onclick="check(this.form)" value="SIGN IN" name="submit">
<br><br> 
<div class="footer">
<p>
&copy; 2023&nbsp;&nbsp;Dialog Axiata PLC&nbsp;&nbsp; Powered By Network Analytics and Automation Support - Group Technology&nbsp;&nbsp;|&nbsp;&nbsp;Version 1.0
</p>
</div>
<br>
</div> 
</form>
<script>
function togglePasswordVisibility(icon) {
  const passwordInput = icon.previousElementSibling;

  if (passwordInput.getAttribute('type') === 'password') {
    passwordInput.setAttribute('type', 'text');
    icon.classList.add('visible');
  } else {
    passwordInput.setAttribute('type', 'password');
    icon.classList.remove('visible');
  }
}
</script>
</body>
</html>
