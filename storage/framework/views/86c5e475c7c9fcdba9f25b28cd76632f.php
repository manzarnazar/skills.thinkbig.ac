<?php
    $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
?>
<?php if($cookie->data_values->status == 1 && !\Cookie::get('gdpr_cookie')): ?>
    <!-- cookies dark version start -->
    <div class="d-flex justify-content-center">
        <div class="cookies-card hide text-center">
            <p class="cookies-card__content"><?php echo e($cookie->data_values->short_desc); ?> <a class="text--base"
                    href="<?php echo e(route('cookie.policy')); ?>" target="_blank"><?php echo app('translator')->get('learn more'); ?></a> <a href="javascript:void(0)"
                    class="btn btn--base btn--sm border-none policy ms-4"><?php echo app('translator')->get('Accept'); ?></a></p>
        </div>
    </div>
    <!-- cookies dark version end -->
<?php endif; ?>
<?php /**PATH /home/thingpfd/skills.thinkbig.ac/application/resources/views/presets/default/components/cookie_popup.blade.php ENDPATH**/ ?>