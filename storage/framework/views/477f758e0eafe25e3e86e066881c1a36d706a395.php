<html>
<head>
<link rel="stylesheet" href="css/table.css" >
</head>
<body>  
  <form method="POST" action="add-company" id="login-form" class="login-form" autocomplete="off" role="main">
           <?php echo csrf_field(); ?>
  <h1 class="a11y-hidden">Add Company</h1>
  
  
  <div>
    <label class="label-email">
      <input type="text" class="text" name="brc" placeholder="Enter BRC" tabindex="1" required />
      <span class="required">Enter BRC</span>
    </label>
  </div>
  
  
  <div>
    <label class="label-password">
      <input type="text" class="text" name="name" placeholder="Enter Name" tabindex="2" required />
      <span class="required">Enter Name</span>
    </label>
  </div>
  
  
   <div>
    <label class="label-password">
      <input type="text" class="text" name="contact_person" placeholder="Enter contact person name" tabindex="2" required />
      <span class="required">Enter contact person name</span>
    </label>
  </div> 
  
  
  <div>
    <label class="label-password">
      <input type="text" class="text" name="mobile" placeholder="Enter Mobile Number" tabindex="2" required />
      <span class="required">Enter Mobile Number</span>
    </label>
  </div> 
  
  
  <div>
    <label class="label-password">
      <input type="text" class="text" name="email" placeholder="Enter Email" tabindex="2" required />
      <span class="required">Enter Email</span>
    </label>
  </div> 
  
  
  <input type="submit" value="Submit Data" />


  <figure aria-hidden="true">
    <div class="person-body"></div>
    <div class="neck skin"></div>
    <div class="head skin">
      <div class="eyes"></div>
      <div class="mouth"></div>
    </div>
    <div class="hair"></div>
    <div class="ears"></div>
    <div class="shirt-1"></div>
    <div class="shirt-2"></div>
  </figure>
</form>
</body>
</html><?php /**PATH /data/RiskRegistry/resources/views/addCompany.blade.php ENDPATH**/ ?>