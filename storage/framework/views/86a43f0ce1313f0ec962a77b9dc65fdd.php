<?php
    $servicesElements = getContent('services.element', false, 4);
?>


<section class="key-section <?php echo e(Route::is('home') ? 'pt-120' :''); ?>">
    <div class="key-item">
        <span class="key-element1">
            <svg class="vector" width="254" height="202" viewBox="0 0 254 202" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.2"
                    d="M253.9 202C254.118 198.809 253.979 195.6 253.489 192.449C250.915 175.915 239.022 160.101 224.295 160.223C215.845 160.287 208.053 165.394 201.158 170.995C194.262 176.596 187.637 182.955 179.642 186.186C171.648 189.417 161.744 188.755 156.009 181.657C151.502 176.095 149.508 166.884 143.051 165.162C134.967 163.004 128.888 174.862 120.624 175.774C114.759 176.416 109.463 171.168 106.956 165.085C104.449 159.002 104.004 152.136 102.883 145.539C101.762 138.942 99.6886 132.05 94.9957 128.023C88.0944 122.075 78.258 124.259 70.2074 127.792C62.1568 131.324 53.7682 136.052 45.2556 134.292C33.2333 131.813 26.101 117.649 22.1574 104.469C17.0234 87.478 14.3148 69.6578 14.135 51.6883C14.0336 40.3769 14.9068 28.7828 11.966 17.9852C9.98295 10.6755 5.63372 3.73194 0 0V202H253.9Z" />
            </svg>

        </span>
        <span class="key-element2">
            <svg class="vector" width="288" height="150" viewBox="0 0 288 150" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M288 0H0.0246596C-0.355119 14.0034 3.66225 27.701 11.3526 38.6236C19.9666 50.5726 32.3756 58.1466 45.8687 59.691C57.3672 60.9211 68.8658 57.6745 80.4121 57.3553C91.9584 57.0361 104.788 60.7576 111.004 71.8596C119.152 86.4028 112.369 106.061 116.689 122.613C121.52 141.103 140.143 151.699 156.951 149.776C173.758 147.853 188.601 135.973 200.133 121.858C211.666 107.743 220.674 91.2142 231.442 76.3285C238.048 67.2039 247.554 57.9159 257.558 61.0379C267.112 64.0119 271.397 76.8423 271.697 88.1001C271.998 99.3578 269.773 110.888 272.38 121.757C274.591 130.951 280.534 138.737 287.959 143.073L288 0Z" />
            </svg>

        </span>

        <div class="container">
            <div class="row gy-5">
                <?php $__empty_1 = true; $__currentLoopData = $servicesElements ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-lg-3">
                        <div class="key-box">
                            <div class="icon-wrap">
                                <img src="<?php echo e(getImage(getFilePath('services') . '/' .$item->data_values?->image)); ?>" alt="image">
                            </div>
                            <div class="content-wrap">
                                <h6 class="title"><?php echo e(@$item->data_values?->title); ?></h6>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/presets/default/sections/services.blade.php ENDPATH**/ ?>