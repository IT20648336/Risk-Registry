
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!DOCTYPE html>
<html>
<head>
<style>

txt1{
    position: right;
    left: 50px;
    right: 60px;
    top: 60px;
    bottom: 80.86%;
}
</style>
</head>
<Body>

<p><font size="4%" color="#474747">Company Details</font></p>


<div class="center">
  <button id="show-submit">+Add New Company</button>
</div>


<form method="post" align="center" enctype="multipart/form-data" id="AddCompany" class="form"> 
  <?php echo csrf_field(); ?>
<div class="popup">
  <div class="close-btn">&times;</div>
  <div class="form">
  <h2>Add Company</h2> 
    <div class="form-element">
        <label for="brc">Enter BRC</label>
        <input type="text" id="brc" name="brc" placeholder="Enter BRC">
    </div>
    
    <div class="form-element">
        <label for="name">Company Name</label>
        <input type="text" id="name" name="name" placeholder="Enter Name" required>
    </div>
    
    <div class="form-element">
        <label for="contact_person">Contact Person Name</label>
        <input type="text" id="contact_person" name="contact_person" placeholder="Enter Contact Person Name" required>
    </div>
    
    <div class="form-element">
        <label for="mobile_number">Mobile Number</label>
        <input type="text" id="mobile" name="mobile" placeholder="Enter Mobile Number" required>
    </div>
    
    <div class="form-element">
        <label for="email">Enter Email</label>
        <input type="text" id="email" name="email" placeholder="Enter Email" required>
    </div>
    
    <div class="form-element">
      <input class="button" style="width: auto; height: 30px; padding: 3px 10px 10px; border-radius: 5px; font-size: 12px; text-align: center; background-color:#4A3B94;" type="button" value="SAVE" onclick="AddNewCompany('AddNewCompany'); return false;" />
    </div>

</div>
</div>
</form>


<script>
  document.querySelector("#show-submit").addEventListener("click",function(){
      document.querySelector(".popup").classList.add("active");
  });
  
    document.querySelector(".popup .close-btn").addEventListener("click",function(){
      document.querySelector(".popup").classList.remove("active");
  });

</script>  
<form method="post" align="center" enctype="multipart/form-data" id="EditCompany" > 
  <?php echo csrf_field(); ?>
<table id="customers" style="margin-top:100px; width: 70%;">
  <tr>

    <th>Company Name</th>
    <th>Contact Person Name </th>
    <th>Mobile Number</th>
    <th>Email Address</th>
    <th>Status</th>
    <th style="width: 20%">Action</th>
  </tr>
      <?php $__currentLoopData = $company1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
          <td><?php echo e($company['name']); ?></td>
          <td><?php echo e($company['contact_person']); ?></td>
          <td><?php echo e($company['mobile']); ?></td>
          <td><?php echo e($company['email']); ?></td>
          <td><?php if($company['status']): ?> <div style="text-align:center">&nbsp;<p style="color:green;" class="txt1">&#9679; <b>Active </b></p></span></div>
              <?php else: ?> <div style="text-align:center">&nbsp;<p style="color:red;" class="txt1">&#9679; <b>Rejected</b> </p></span></div> <?php endif; ?></td>
          <td>
          
          

          <input data-id="<?php echo e($company->id); ?>" id="toggle_btn" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enable" data-off="Disable" <?php echo e($company->status ? 'checked' : ''); ?> >
          
          <button type="submit" style="background-color:rgba(255,255,255,0.0); border:none;" id="resultButton" onclick="showResults();"><img src="/images/pencil.png" / style="width:auto;height:20px;" align="-80%" data-toggle="modal" data-target="#EditCompanyData" onclick="EditNewCompany('EditNewCompany?RowId=<?php echo e($company['id']); ?>'); return false;" id="button">&nbsp &nbsp Edit</button> 
<label class="switch">

          </td>
          
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
</table>
</form>

<div id="EditCompanyData" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:60%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="ContainerHeader" style="width:100%; background-color:#E5E5E5; color:#000000; border-radius: 0px">
UPDATE COMPANY
<button type="button" class="close" data-dismiss="modal">×&nbsp;</button>
</div>
<div class="modal-body" align="center" style="width:100%;">
<form method="post" align="center" enctype="multipart/form-data" id="UpdateCompanyData">
    <?php echo csrf_field(); ?>
                <table style="width: 95%;height: auto;margin: 0px auto; border: hidden;">  
                    <tr>
                        <td style="border:hidden;text-align: left; width:14%;"><br> 
                          <label for="Student"><b>BRC</b></label><br>                      
                            <input type="text" id="EditBRC" name="EditBRC"  />                      
                        </td>
                        <td style="border:hidden;text-align: left; width:14%;"><br>
                          <label for="Student"><b>NAME</b></label><br>                      
                            <input type="text" id="EditCompanyName" name="EditCompanyName"  />                     
                        </td>  
                        <td style="border:hidden;text-align: left; width:14%;"><br>
                          <label for="Student"><b>CONTACT PERSON</b></label><br>                      
                            <input type="text" id="EditCompanyContactPerson" name="EditCompanyContactPerson" />                     
                        </td>
                        <td style="border:hidden;text-align: left; width:14%;"><br>
                          <label for="Student"><b>MOBILE</b></label><br>                      
                            <input type="text" id="EditCompanyMobile" name="EditCompanyMobile" />                     
                        </td>                        
                      </tr>
                      <tr>
                       <td style="border:hidden;text-align: left; width:14%;"><br>
                            <label for="Student"><b>EMAIL</b></label><br>
                            <input type="email" id="EditCompanyEmail" name="EditCompanyEmail" />
                        </td>
                      </tr>
                  </table>
        <br>
        <input class="button" style="width: auto; height: 25px; padding: 2px 10px 10px; border-radius: 5px; font-size: 12px; text-align: center; background-color: #00638B;" type="button" value="UPDATE" onclick="UpdateCompany('UpdateCompany'); return false;" />
<input type='hidden' name='EditRowId' id='EditRowId' />
</form>
</div>
</div>
 </div>
</div>

</Body>

</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /data/RiskRegistry/resources/views/CompanyN.blade.php ENDPATH**/ ?>