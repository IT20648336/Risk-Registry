
<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <!-- Design by foolishdeveloper.com -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
 @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap');

 body {
  font-family: raleway;
  color: white;
  margin: 0;
  background:#F8F9F9;
	font-family: 'Open Sans', sans-serif;
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
	margin: 0;
}

.popup .content {
 position: absolute;
 top: 50%;
 left: 50%;
 transform: translate(-50%,-150%) scale(0);
 width: 300px;
 height: 450px;
 z-index: 2;
 text-align: center;
 padding: 10px;
 border-radius: 20px;
 z-index: 1;
}

.popup .close-btn {
 position: absolute;
 right: 25px;
 top: 40px;
 width: 25px;
 height: 30px;
 color: white;
 font-size: 20px;
 border-radius: 50%;
 padding: 2px 5px 7px 5px;
 background: black;
 }

.popup.active .content {
transition: all 300ms ease-in-out;
transform: translate(-50%,-50%) scale(1);
}

.first-button {
color: white;
font-size: 18px;
font-weight: 500;
padding: 20px 20px;
border-radius: 40px;
border: none;
position: absolute;
top: 50%;
left: 20%;
transform: translate(20%, -300%);
background: #262626;
transition: box-shadow .35s ease !important;
outline: none;
}

.first-button:active {  
background: linear-gradient(145deg, #222222, #292929);
box-shadow:  5px 5px 10px #262626, 
             -5px -5px 10px #262626;
border: none;
}
.second-button:active{
background: linear-gradient(145deg,#222222, #292929);
box-shadow: 5px 5px 10px #262626, -5px -5px 10px #262626;
border: none;
outline: none;
}

@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,500&display=swap');

* {
	box-sizing: border-box;
}

.container {
	background-color: #fff;
	border-radius: 5px;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
	overflow: hidden;
	width: 300px;
  height:600px;
	max-width: 100%;
  display: block;
}

.header {
	border-bottom: 1px solid #f0f0f0;
	background-color: #f7f7f7;
	padding: 20px 40px;
}

.header h2 {
	margin: 0;
}

.form {
	padding: 30px 40px;	
}

.form-control {
	margin-bottom: 10px;
	padding-bottom: 70px;
	position: relative;
}

.form-control label {
	display: inline-block;
	margin-bottom: 5px;
 color: black;
}

.form-control input {
	border: 2px solid #f0f0f0;
	border-radius: 4px;
	display: block;
	font-family: inherit;
	font-size: 14px;
	padding: 10px;
	width: 150%;
  margin: -23%;
}

.form-control input:focus {
	outline: 0;
	border-color: #777;
}

.form-control.success input {
	border-color: #2ecc71;
}

.form-control.error input {
	border-color: #e74c3c;
}

.form-control i {
	visibility: hidden;
	position: absolute;
	top: 40px;
	right: 10px;
}

.form-control.success i.fa-check-circle {
	color: #2ecc71;
	visibility: visible;
}

.form-control.error i.fa-exclamation-circle {
	color: #e74c3c;
	visibility: visible;
}

.form-control small {
	color: #e74c3c;
	position: absolute;
	bottom: 0;
	left: 0;
	visibility: hidden;
}

.form-control.error small {
	visibility: visible;
  padding:15px;
  top:57px;
  display:40px;
  float: left;
  padding-left: -80px;
}

.form button {
	background-color: #8e44ad;
	border: 2px solid #8e44ad;
	border-radius: 4px;
	color: #fff;
	display: block;
	font-family: inherit;
	font-size: 16px;
	padding: 10px;
	margin-top: 20px;
	width: 100%;
}
  
</style>
</head>
<body>
 <div class="popup" id="popup-1">
   <div class="content">
    <div class="close-btn" onclick="togglePopup()"> × </div>
     
<div class="container">
	<div class="header">
		<h2>Add Company</h2>
	</div>
 
 
	<form id="form" class="form">
    
		<div class="form-control">
			  <label for="username">BRC</label>
           <input type="text" id="brc" name="brc" placeholder="Ex:-178920">
			       <i class="fas fa-check-circle"></i>
			         <i class="fas fa-exclamation-circle"></i>
			            <small>Error message</small>
		</div>
    
    <div class="form-control">
			  <label for="username">Company Name</label>
			    <input type="text" placeholder="Dialog" id="companyname" />
			       <i class="fas fa-check-circle"></i>
			         <i class="fas fa-exclamation-circle"></i>
			            <small>Error message</small>
		</div>
    
    <div class="form-control">
			   <label for="username">Contact Persoan Name</label>
			      <input type="text" placeholder="Amal" id="password"/>
			         <i class="fas fa-check-circle"></i>
			            <i class="fas fa-exclamation-circle"></i>
			               <small>Error message</small>
		</div>
    
		<div class="form-control">
			<label for="username">Email</label>
			    <input type="email" placeholder="a@florin-pop.com" id="email" />
			       <i class="fas fa-check-circle"></i>
			         <i class="fas fa-exclamation-circle"></i>
			            <small>Error message</small>
		</div>
    
		<div class="form-control">
			<label for="username">Mobile Number</label>
			   <input type="text" placeholder="0761595639" id="password2"/>
			        <i class="fas fa-check-circle"></i>
			           <i class="fas fa-exclamation-circle"></i>
			              <small>Error message</small>
		</div>
    
		<button>Submit</button>
	</form>
</div>      
     
   </div>
  </div>
  <button onclick="togglePopup()" class="first-button">Add Company</button>
<script>
 function togglePopup() {
 document.getElementById("popup-1")
  .classList.toggle("active");
}
const form = document.getElementById('form');
const brc = document.getElementById('brc');
const companyname = document.getElementById('companyname');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

form.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {
	// trim to remove the whitespaces
	const brcValue = brc.value.trim();
  const companynamevalue = companyname.value.trim();
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
	const password2Value = password2.value.trim();
	
	if(brcValue === '') {
		setErrorFor(brc, 'BRC cannot be blank');
	} else {
		setSuccessFor(brc);
	}
  
  if(companynamevalue ===''){
    setErrorFor(companyname,'company name cannot be blank');
  }else{
    setSuccessFor(companyname);
  }
	
	if(emailValue === '') {
		setErrorFor(email, 'Email cannot be blank');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Not a valid email');
	} else {
		setSuccessFor(email);
	}
	
	if(passwordValue === '') {
		setErrorFor(password, 'Contact persoan cannot be blank');
	} else {
		setSuccessFor(password);
	}/*
	if (password2Value < 10 || password2Value > 10) {
		setErrorFor(password2, 'Mobile Number cannot be blank');
  }*/
  if(password2Value ===''){
    setErrorFor(password2, 'Mobile Number cannot be blank');
  }else{
    setSuccessFor(password2);
  }
}
  
function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}
</script>

</body>
</html> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('NavBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/PopupForm.blade.php ENDPATH**/ ?>