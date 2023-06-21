<title>MAIL TEMPLATES</title>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<h2 style="color:#4A3B94;position:absolute;left:285px";align="right">MAIL TEMPLATES</h2>

<br><br>
<form method="post" align="center" enctype="multipart/form-data" id="MailTempaltes" >
<?php echo csrf_field(); ?>
<table>
<tr>
    <th>
    <h5>SCENARIO</h5>
    </th>
    <th>
    <h5>SUBJECT</h5>
    </th>
     <th>
    <h5>DESCRIPTION</h5>
    </th>
    <th>
    <h5></h5>
    </th>
  
   
   
</tr>

<?php $__currentLoopData = $Mail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<tr>
    <td>
    <h4><?php echo e($data->Scenario); ?></h4>
    </td>
    <td>
    <h4><?php echo e($data->Subject); ?></h4>
    </td>
    <td>
   <h4><?php echo e(strlen($data->Description) > 50 ? substr($data->Description, 0, 50) . "..." : $data->Description); ?></h4>
    </td>
     <td>
                <button class="button" style="height: 20px; margin-top: 1px;" type="button" data-toggle="modal" data-target="#editModal<?php echo e($data->id); ?>" >EDIT</button>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo e($data->id); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo e($data->id); ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel<?php echo e($data->id); ?>">Edit Mail Template</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="subject<?php echo e($data->id); ?>">SUBJECT</label><br>
                                    <input type="text" class="form-control" id="subject<?php echo e($data->id); ?>" name="subject<?php echo e($data->id); ?>" value="<?php echo e($data->Subject); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="description<?php echo e($data->id); ?>">DESCRIPTION</label><br>
                                    <input type="text" class="form-control" id="description<?php echo e($data->id); ?>" name="description<?php echo e($data->id); ?>" value="<?php echo e($data->Description); ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">SAVE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</form>









<?php /**PATH /data/RiskRegistry/resources/views//Email/MailTemplates.blade.php ENDPATH**/ ?>