

<?php $__env->startSection('panel'); ?>
<?php if(@json_decode($general->system_info)->message): ?>
<div class="row">
    <?php $__currentLoopData = json_decode($general->system_info)->message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-12">
        <div class="alert border border--primary" role="alert">
            <div class="alert__icon bg--primary"><i class="far fa-bell"></i></div>
            <p class="alert__message"><?php echo $msg; ?></p>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<div class="row gy-4">
    <div class="col-xl-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo app('translator')->get('Monthly Payments & Withdraw Report'); ?> (<?php echo app('translator')->get('This year'); ?>)</h5>
                <div id="account-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo app('translator')->get('Daily Logins'); ?> (<?php echo app('translator')->get('Last 10 days'); ?>)</h5>
                <div id="login-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="row gy-4">
            <div class="col-sm-6">
                <a href="<?php echo e(route('admin.deposit.list')); ?>">
                    <div class="card prod-p-card background-pattern">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5"><?php echo app('translator')->get('Total Payments'); ?></h6>
                                    <h3 class="m-b-0"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($deposit['total_deposit_amount'])); ?></h3>
                                </div>
                                <div class="col-auto">
                                    <i class="dashboard-widget__icon fas fa-hand-holding-usd"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="<?php echo e(route('admin.deposit.list')); ?>">
                    <div class="card prod-p-card background-pattern-white bg--primary">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white"><?php echo app('translator')->get('Payment Charge'); ?></h6>
                                    <h3 class="m-b-0 text-white"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($deposit['total_deposit_charge'])); ?></h3>
                                </div>
                                <div class="col-auto">
                                    <i class="dashboard-widget__icon fas fa-percentage text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="<?php echo e(route('admin.withdraw.log')); ?>">
                    <div class="card prod-p-card background-pattern-white bg--primary">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5 text-white"><?php echo app('translator')->get('Total Withdrawal'); ?></h6>
                                    <h3 class="m-b-0 text-white"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($withdrawals['total_withdraw_amount'])); ?></h3>
                                </div>
                                <div class="col-auto">
                                    <i class="dashboard-widget__icon lar la-credit-card text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="<?php echo e(route('admin.withdraw.approved')); ?>">
                    <div class="card prod-p-card background-pattern">
                        <div class="card-body">
                            <div class="row align-items-center m-b-0">
                                <div class="col">
                                    <h6 class="m-b-5"><?php echo app('translator')->get('Withdrawal Charge'); ?></h6>
                                    <h3 class="m-b-0"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($withdrawals['total_withdraw_charge'])); ?></h3>
                                </div>
                                <div class="col-auto">
                                    <i class="dashboard-widget__icon fas fa-percentage"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-12">
                <div class="card p-3 rounded-3">
                    <div class="row g-0">
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-users"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="<?php echo app('translator')->get('View all'); ?>" class="dashboard-widget-link"
                                        href="<?php echo e(route('admin.users.all')); ?>"></a>
                                    <h5><?php echo e($widget['total_users']); ?></h5>
                                    <span><?php echo app('translator')->get('Total Users'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4 ">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-user-check"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="<?php echo app('translator')->get('View all'); ?>" class="dashboard-widget-link"
                                        href="<?php echo e(route('admin.users.active')); ?>"></a>
                                    <h5><?php echo e($widget['verified_users']); ?></h5>
                                    <span><?php echo app('translator')->get('Active Users'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-envelope"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="<?php echo app('translator')->get('View all'); ?>" class="dashboard-widget-link"
                                        href="<?php echo e(route('admin.users.email.unverified')); ?>"></a>
                                    <h5><?php echo e($widget['email_unverified_users']); ?></h5>
                                    <span><?php echo app('translator')->get('Email Unverified'); ?></span>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-credit-card"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="<?php echo app('translator')->get('View all'); ?>" class="dashboard-widget-link"
                                        href="<?php echo e(route('admin.withdraw.pending')); ?>"></a>
                                    <h5><?php echo e($withdrawals['total_withdraw_pending']); ?></h5>
                                    <span><?php echo app('translator')->get('Pending Withdrawals'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-spinner"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="<?php echo app('translator')->get('View all'); ?>" class="dashboard-widget-link"
                                        href="<?php echo e(route('admin.deposit.pending')); ?>"></a>
                                    <h5><?php echo e($deposit['total_deposit_pending']); ?></h5>
                                    <span><?php echo app('translator')->get('Pending Payments'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6 col-xl-6 col-xxl-4">
                            <div class="dashboard-widget">
                                <div class="dashboard-widget__icon">
                                    <i class="dashboard-card-icon las la-ban"></i>
                                </div>
                                <div class="dashboard-widget__content">
                                    <a title="<?php echo app('translator')->get('View all'); ?>" class="dashboard-widget-link"
                                        href="<?php echo e(route('admin.deposit.rejected')); ?>">
                                    </a>
                                    <h5><?php echo e($deposit['total_deposit_rejected']); ?></h5>
                                    <span><?php echo app('translator')->get('Rejected Payments'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title"><?php echo app('translator')->get('Recent Tickets'); ?></h5>
                    <a href="<?php echo e(route('admin.ticket.pending')); ?>" class="float-end" target="_blank"><?php echo app('translator')->get('View all'); ?></a>
                </div>
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Subject'); ?></th>
                                <th><?php echo app('translator')->get('Status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $newTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <a class="" href="<?php echo e(route('admin.ticket.view', $item->id)); ?>" class="fw-bold">
                                        <?php echo app('translator')->get('Ticket'); ?>#<?php echo e($item->ticket); ?> - <?php echo e(strLimit($item->subject,30)); ?> </a>
                                </td>
                                <td>
                                    <?php echo $item->statusBadge; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<script src="<?php echo e(asset('assets/admin/js/apexcharts.min.js')); ?>"></script>

<script>
    "use strict";
    // [ account-chart ] start
    (function () {
        var options = {
            chart: {
                type: 'area',
                stacked: false,
                height: '310px'
            },
            stroke: {
                width: [0, 3],
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%'
                }
            },
            colors: ['#BADA55', '#67BAA7'],
            series: [{
                name: '<?php echo app('translator')->get("Withdrawals"); ?>',
                type: 'column',
                data: <?php echo json_encode($withdrawalsChart['values'], 15, 512) ?>
    }, {
        name: '<?php echo app('translator')->get("Payments"); ?>',
        type: 'area',
        data: <?php echo json_encode($depositsChart['values'], 15, 512) ?>
    }],
    fill: {
        opacity: [0.85, 1],
                },
    labels: <?php echo json_encode($depositsChart['labels'], 15, 512) ?>,
    markers: {
        size: 0
    },
    xaxis: {
        type: 'text'
    },
    yaxis: {
        min: 0
    },
    tooltip: {
        shared: true,
            intersect: false,
                y: {
            formatter: function (y) {
                if (typeof y !== "undefined") {
                    return "$ " + y.toFixed(0);
                }
                return y;

            }
        }
    },
    legend: {
        labels: {
            useSeriesColors: true
        },
        markers: {
            customHTML: [
                function () {
                    return ''
                },
                function () {
                    return ''
                }
            ]
        }
    }
            }
    var chart = new ApexCharts(
        document.querySelector("#account-chart"),
        options
    );
    chart.render();
        }) ();

    // [ login-chart ] start
    (function () {
        var options = {
            series: [{
                name: "User Count",
                data: <?php echo json_encode($userLogins['values'], 15, 512) ?>
    }],
    chart: {
        height: '310px',
            type: 'area',
                zoom: {
            enabled: false
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    colors: ['#BADA55'],
        labels: <?php echo json_encode($userLogins['labels'], 15, 512) ?>,
    xaxis: {
        type: 'date',
            },
    yaxis: {
        opposite: true
    },
    legend: {
        horizontalAlign: 'left'
    }
        };

    var chart = new ApexCharts(document.querySelector("#login-chart"), options);
    chart.render();
    }) ();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>