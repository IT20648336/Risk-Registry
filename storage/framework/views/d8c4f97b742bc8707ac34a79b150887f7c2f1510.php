<title>Sent Items</title>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<h2 style="color:#4A3B94;position:absolute;left:328px";align="right">SENT ITEMS</h2>

<br><br>
<form method="post" align="center" enctype="multipart/form-data" id="SentItems" >
<?php echo csrf_field(); ?>




 <table id="example" class="table table-bordered site_data_datatable" style="padding: -30px; border-style: hidden; width: 98%;">
<thead style="border: 1px solid #E6E6E6;">
    
        <tr>
            <th ><h5>SENDER'S NAME</h5></th>
            <th><h5>RECIEVER'S NAME</h5></th>
            <th ><h5>SUBJECT<h/h5></th>
            <th ><h5>DATE/TIME</h5></th>
        </tr>
    </thead>
    <tbody style="border-top-style:hidden; border-bottom-style:hidden;">
        <?php $__currentLoopData = $emailLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emailLog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><h4><?php echo e($emailLog->Sender_Name); ?></h4></td>
                <td><h4><?php echo e($emailLog->Receiver_Name); ?></h4></td>
                <td><h4><?php echo e($emailLog->Subject); ?></h4></td>
                <td><h4><?php echo e($emailLog->Date_Time); ?></h4></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH /data/RiskRegistry/resources/views/Email/SentItems.blade.php ENDPATH**/ ?>