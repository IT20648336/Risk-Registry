<title>MAIL TEMPLATES</title>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<head>
    <style>
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }
        .custom-modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 2px solid black;
            width: 50%;
        }
        .custom-modal-content input[type="text"] {
            width: 100%;
            padding: 5px;
            font-size: 14px;
            color: black;
          
            border: 1px solid black;
        }
        .custom-modal-content textarea {
            width: 100%;
            height: 200px;
            padding: 5px;
            font-size: 14px;
            color: black;
       
            border: 1px solid black;
        }
        .custom-modal-content h5 {
            text-align: center;
        }
    </style>
</head>

<h2 style="color: #4A3B94; position: absolute; left: 285px;" align="right">MAIL TEMPLATES</h2>

<br><br>
<form method="post" align="center" enctype="multipart/form-data" id="MailTemplates">
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
                <h4 class="black-text"><?php echo e($data->Scenario); ?></h4>
            </td>
            <td>
                <h4 class="black-text"><?php echo e($data->Subject); ?></h4>
            </td>
            <td>
                <h4><?php echo e(strlen($data->Description) > 50 ? substr($data->Description, 0, 50) . "..." : $data->Description); ?></h4>
            </td>
            <td>
                <button class="button" style="height: 20px; margin-top: 1px;" type="button" onclick="openModal('editModal<?php echo e($data->Id); ?>')">VIEW</button>

                <!-- Edit Modal -->
                <div class="custom-modal" id="editModal<?php echo e($data->Id); ?>">
                    <div class="custom-modal-content">
                        <h5> Mail TemplateS</h5>
                        <div class="form-group">
                            <label for="subject<?php echo e($data->Id); ?>">SUBJECT</label><br>
                            <input type="text" id="subject<?php echo e($data->Id); ?>" name="subject<?php echo e($data->Id); ?>" value="<?php echo e($data->Subject); ?>">
                        </div>
                        <div class="form-group">
                            <label for="description<?php echo e($data->Id); ?>">DESCRIPTION</label><br>
                            <?php
                                $rows = explode('.', $data->Description);
                                $description = implode("\n\n", $rows);
                            ?>
                            <textarea id="description<?php echo e($data->Id); ?>" name="description<?php echo e($data->Id); ?>"><?php echo e($description); ?></textarea>
                        </div>
                        <div>
                            <button type="button" onclick="closeModal('editModal<?php echo e($data->Id); ?>')">CLOSE</button>
                            

                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</form>





<script>
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }
    
</script>


<?php /**PATH /data/RiskRegistry/resources/views/Email/MailTemplates.blade.php ENDPATH**/ ?>