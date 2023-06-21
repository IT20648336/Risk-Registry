<!DOCTYPE html>
<html>
<body>

<div>
    <label for="department">Department:</label>
    <select id="department">
        <option value="">Select Department</option>
        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($department); ?>"><?php echo e($department); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div>
    <label for="division">Division:</label>
    <select id="division">
        <option value="">Select Division</option>
    </select>
</div>

<script>
    $(document).ready(function() {
        // When the department dropdown is changed
        $('#department').change(function() {
            var department = $(this).val();

            // Send an AJAX request to get the divisions for the selected department
            $.ajax({
                url: '<?php echo e(url('/get-divisions')); ?>',
                type: 'POST',
                data: {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    'department': department
                },
                success: function(response) {
                    // Clear the existing divisions and add the new divisions
                    $('#division').empty();
                    $('#division').append($('<option>', {
                        value: '',
                        text: 'Select Division'
                    }));
                    $.each(response, function(key, value) {
                        $('#division').append($('<option>', {
                            value: value,
                            text: value
                        }));
                    });
                }
            });
        });
    });
</script>

</body>
</html><?php /**PATH /data/RiskRegistry/resources/views/Test/test.blade.php ENDPATH**/ ?>