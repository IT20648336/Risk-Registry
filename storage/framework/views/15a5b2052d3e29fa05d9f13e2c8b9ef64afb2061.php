<title>ALL RISKS</title>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<head>
    <script src="<?php echo e(asset('tinymce/js/tinymce/tinymce.min.js')); ?>"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="<?php echo e(asset('js/Category.js')); ?>"></script>
<style>
    .department-optgroup::before {
        content: '\25BC';
        display: inline-block;
        margin-right: 5px;
    }
</style>

</head>

<body>
    <h2 style="color:#4A3B94;position:absolute;left:285px";align="right">ALL RISKS</h2>

<select id="division_select" name="division" style="<?php if($Role == 'Admin'): ?> display: none; <?php endif; ?>">
    <option value="all"><h4>All Risks</h4></option>
    <?php
        $departments = [];
    ?>
    <?php $__currentLoopData = $Divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $department = $division->Department_Name;
            if (!in_array($department, $departments)) {
                $departments[] = $department;
                echo '<optgroup class="department-optgroup" label="&#9660; ' . $department . '">';
            }
        ?>
        <option class="division-option" value="<?php echo e($division->Name); ?>" data-department="<?php echo e($department); ?>">&#9658; <?php echo e($division->Name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </optgroup>
</select>

    <br><br>
<form action="/filter-portfolio" method="POST" enctype="multipart/form-data" id="MyRisks">
        <?php echo csrf_field(); ?>
        <table id="example" class="table table-bordered site_data_datatable" style="padding: -30px; border-style: hidden; width: 98%;">
<thead style="border: 1px solid #E6E6E6;">
                <tr>
                    <th>
                        <h5>CREATED DATE</h5>
                    </th>
                    <th>
                        <h5>RISK ID</h5>
                    </th>
                    <th>
                        <h5>TYPE</h5>
                    </th>
                    <th>
                        <h5>DIVISION</h5>
                    </th>
                    <th>
                        <h5>OWNER</h5>
                    </th>
                    <th>
                        <h5>CATEGORY</h5>
                    </th>
                    <th>
                        <h5>STATUS</h5>
                    </th>                    
                    <th></th>
                </tr>
            </thead>
            <tbody style="border-top-style:hidden; border-bottom-style:hidden;">

                <?php $__currentLoopData = $risks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php

                if($data->Request_status == 'Draft'):
                $Color='#EBEBEB';
                $FontColor='#000000';
                elseif( $data->Request_status == 'In-Progress'):
                $Color='#ECEDFF';
                $FontColor='#000C9F';
                elseif( $data->Request_status == 'Reject'):
                $Color='#FFE4E4';
                $FontColor='#FFE4E4';
                elseif( $data->Request_status == 'Completed'):
                $Color='#E5FFE5';
                $FontColor='#008F02';
                else:
                $Color='#EBEBEB';
                $FontColor='#000000';
                endif;

                ?>

                <tr class="risk-row" data-division="<?php echo e($data->Division_Name); ?>">
                    <td>
                        <h4><?php echo e($data->Date_Time); ?></h4>
                        <input type="hidden" name="selectedRows[<?php echo e($key); ?>][Date_Time]" value="<?php echo e($data->Date_Time); ?>">
                    </td>
                    <td>
                        <h4><?php echo e($data->Id); ?></h4>
                        <input type="hidden" name="selectedRows[<?php echo e($key); ?>][Id]" value="<?php echo e($data->Id); ?>">
                    </td>
                    <td>
                        <h4><?php echo e($data->Type); ?></h4>
                        <input type="hidden" name="selectedRows[<?php echo e($key); ?>][Type]" value="<?php echo e($data->Type); ?>">
                    </td>
                    <td>
                        <h4><?php echo e($data->Division_Name); ?></h4>
                        <input type="hidden" name="selectedRows[<?php echo e($key); ?>][Division_Name]" value="<?php echo e($data->Division_Name); ?>">
                    </td>
                    <td>
                        <h4><?php echo e($data->Owner_Name); ?></h4>
                        <input type="hidden" name="selectedRows[<?php echo e($key); ?>][Owner_Name]" value="<?php echo e($data->Owner_Name); ?>">
                    </td>
                    <td>
                        <h4><?php echo e($data->Status); ?></h4>
                        <input type="hidden" name="selectedRows[<?php echo e($key); ?>][Status]" value="<?php echo e($data->Status); ?>">
                    </td>
                    <td>
                    <div style="background-color:<?php echo e($Color); ?>; border-radius: 5px;padding: 0px 0px; width:auto; display: inline-block; color:#FFFFFF;text-align: center;">
                    <h4 style="font-size:12px; color:<?php echo e($FontColor); ?>;">&nbsp;<?php echo e($data->Request_status); ?>&nbsp;</h4>
                    <input type="hidden" name="selectedRows[<?php echo e($key); ?>][Request_status]" value="<?php echo e($data->Request_status); ?>">
                    </div>
                    </td>
                    <td>
                    <input class="button" style="height: 20px; margin-top: 1px;" type="button" value="VIEW" data-toggle="modal" data-target="#ViewRiskData"onclick="ViewRiskData('ViewRiskData?RiskId=<?php echo e($data->Id); ?>'); return false;" />&nbsp;
    <input class="button" style="height: 20px; margin-top: 1px; background-color: #007C76;" type="button" value="HISTORY" data-toggle="modal" data-target="#ViewRiskHistory" onclick="ViewRiskHistory('ViewRiskHistory?RiskId=<?php echo e($data->Id); ?>'); return false;" />&nbsp;
    <input class="button" style="height: 20px; margin-top: 1px; background-color: #D3D3D3; color:#000000;" type="button" value="EDIT" onclick="window.open('CreateRisk?RiskId=<?php echo e($data->Id); ?>&Page=1')"/>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <input type="hidden" name="action" value="extract">
        <input type="hidden" id="selectedDivisionInput" name="division" value="">
        <button type="submit" id="extract-btn" class="btn btn-primary">EXTRACT</button>
    </form>

<div id="ViewRiskData" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:100%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="modal-body" align="center" style="width:100%;">
<div id="ViewRiskData1">
</div>
</div>
 </div>
</div>
</div>

<div id="ViewRiskHistory" class="modal fade" role="dialog" style="width:100%;">
<div class="modal-dialog" style="width:70%;">

<!-- Modal content-->
<div class="modal-content" style="width:100%;">
<div class="modal-body" align="center" style="width:100%;">
<div id="ViewRiskHistory1">
</div>
</div>
 </div>
</div>
</div>
    <script>
      $(document).ready(function() {
          $('#division_select').on('change', function() {
              var selectedDivision = $(this).val();
              $('.risk-row').hide();
      
              if (selectedDivision === 'all') {
                  $('.risk-row').show();
                  selectedDivision = ''; 
              } else {
                  $('.risk-row[data-division="' + selectedDivision + '"]').show();
              }
      
              $('#selectedDivisionInput').val(selectedDivision); 
          });
      
          $('#extract-btn').on('click', function() {
              $('#selectedDivisionInput').val($('#division_select').val());
              $('#extract-form').submit();
          });
      });

    </script>
</body>
<?php /**PATH /data/RiskRegistry/resources/views//Risk/AllRisks.blade.php ENDPATH**/ ?>