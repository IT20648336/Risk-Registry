<!DOCTYPE html>
    <html>
    <head>
        <title>Active Inactive Status Using Toggle Button/Slide Laravel 8 - phpcodingstuff.com</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>Laravel Update User Status Using Toggle Button Example - ItSolutionStuff.com</h1>
            <table class="table table-bordered">
                <thead>
                   <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                   </tr> 
                </thead>
                <tbody>
                   <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                         <td><?php echo e($user->name); ?></td>
                         <td><?php echo e($user->email); ?></td>
                         <td>
                            <input data-id="<?php echo e($user->id); ?>" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" <?php echo e($user->status ? 'checked' : ''); ?>>
                         </td>
                      </tr>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </body>
    <script>
      $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var user_id = $(this).data('id'); 
             
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {'status': status, 'user_id': user_id},
                success: function(data){
                  console.log(data.success)
                }
            });
        })
      })
    </script>
    </html><?php /**PATH /data/RiskRegistry/resources/views/users.blade.php ENDPATH**/ ?>