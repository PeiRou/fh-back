<?php $__env->startSection('title', 'Error'); ?>

<?php $__env->startSection('message', 'Too many requests.'); ?>

<?php echo $__env->make('errors::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>