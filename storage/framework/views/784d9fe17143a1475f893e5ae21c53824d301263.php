
<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/Main.css" >
    <script src="https://kit.fontawesome.com/6505c65713.js" crossorigin="anonymous"></script>
   
   
   
   
</head>



<style type="text/css">
  body
  {
	  margin:0px;
	  padding:0px;
	  font-family:Verdana, Geneva, sans-serif;
  }
  
  section:before
  {
	  content:'';
	  position:absolute;
    
	  width:100%;
	  height:100%;
	  background:linear-gradient(45deg,#ff0081,#6827b0);
	  border-radius:0 0 50% 50%/0 0 100% 100%;
	  transform:scaleX(1.2);
	  
  }
  
  section
  {
	  position:relative;
     top:0;
	  width:100%;
	  height:10vh;
	  display:flex;
	  justify-content:center;
	  align-items:center;
	  overflow:hidden;
  }
  
  section .content
  {
	  position:relative;
	  z-index:1;
	  margin:0 auto;
	  max-width:900px;
	  text-align:center;
  }
  
  section .content h2
  {
	  font-size:40px;
	  color:#fff;
  }
  
</style>

<section>
    <div class="content">
      <h2>Department</h2>
    </div>
  </section>


<Body>

<div class ="container">
<form>

<i class="fas fa-search"></i>
 <input type="text" placeholder="Search a company">
 <button type="submit">search</button>

</form>
</div>

    

  

 
 

 
<style>

.btn-text-right{
text-align: right;

}
</style>

<div class="btn-text-right">
<button type="button" class="btn btn-primary" > + Add New Department</button>
</div>
 
 </div>    
    
</Body>

</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('NavBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/Department.blade.php ENDPATH**/ ?>