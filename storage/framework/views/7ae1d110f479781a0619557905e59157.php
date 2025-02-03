<script src="<?php echo e(asset('assets/common/js/sweetalert2.min.js')); ?>"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        customClass: {
            popup: 'colored-toast'
        },
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>


<?php if(session()->has('notify')): ?>
<?php $__currentLoopData = session('notify'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<script>
    Toast.fire({
        icon: '<?php echo e($msg[0]); ?>',
        title: '<?php echo e(__($msg[1])); ?>'
    })
</script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if(isset($errors) && $errors->any()): ?>
<?php
$collection = collect($errors->all());
$errors = $collection->unique();
?>

<script>
    "use strict";
    <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    Toast.fire({
        icon: 'error',
        title: '<?php echo e(__($error)); ?>'
    })

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</script>

<?php endif; ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/includes/notify.blade.php ENDPATH**/ ?>