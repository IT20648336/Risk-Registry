<h1>Add Member</h1>
<form action="add" method="POST">
  <?php echo csrf_field(); ?>
  
  <input type="text" name="name" placeholder="Enter name"><br><br>
  <input type="text" name="email" placeholder="Enter email"><br><br>
  <input type="text" name="address" placeholder="Enter password"><br><br>
<button type="submit"> ADD MEMBER</button>  
  </form><?php /**PATH /data/RiskRegistry/resources/views/addmember.blade.php ENDPATH**/ ?>