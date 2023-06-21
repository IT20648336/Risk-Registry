<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
echo '<script>

swal({title: "'.$ErrorData['title'].'",text: "'.$ErrorData['text'].'",type: "'.$ErrorData['Type'].'"}, 

function() {window.location="/'.$ErrorData['location'].'";});
        
</script>';
?><?php /**PATH /data/RiskRegistry/resources/views/Error.blade.php ENDPATH**/ ?>