<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructor.ticket.pending') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructor.ticket.pending')); ?>"><?php echo app('translator')->get('Pending'); ?>
                    <?php if($pendingTicketCount): ?>
                    <span class="badge rounded-pill bg--white text-muted"><?php echo e($pendingTicketCount); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructor.ticket.closed') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructor.ticket.closed')); ?>"><?php echo app('translator')->get('Closed'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructor.ticket.answered') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructor.ticket.answered')); ?>"><?php echo app('translator')->get('Answered'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::routeIs('admin.instructor.ticket') ? 'active' : ''); ?>"
                    href="<?php echo e(route('admin.instructor.ticket')); ?>"><?php echo app('translator')->get('All'); ?>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/components/tabs/instructor_ticket.blade.php ENDPATH**/ ?>