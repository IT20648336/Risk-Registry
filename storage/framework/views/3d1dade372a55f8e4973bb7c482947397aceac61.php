.divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}

<?php echo $__env->yieldContent('content'); ?><?php /**PATH /data/RiskRegistry/resources/views/home.blade.php ENDPATH**/ ?>