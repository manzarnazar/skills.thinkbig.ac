<?php
    $footerSection = getContent('footer.content', true);
    $contactSection = getContent('contact.content', true);
    $footerSectionElements = getContent('footer.element', false);
    $pages = App\Models\Page::where('tempname', $activeTemplate)->get();
    $policyElements = getContent('policy_pages.element', false);
?>




<!-- blog section -->
<!-- ==================== Footer Start Here ==================== -->
<footer class="footer-area">
    <div class="footer-top py-115">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <div class="footer-item__logo wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                            <a href="<?php echo e(route('home')); ?>" class="footer-logo-normal" id="footer-logo-normal"> <img
                                    src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo_white.png')); ?>"
                                    alt="logo"></a>
                        </div>
                        <div class="footer-item__desc wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                            <?php echo @$contactSection->data_values?->short_description;?>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title"><?php echo app('translator')->get('Quick Links'); ?></h5>
                        <ul class="footer-menu">
                            <?php $__currentLoopData = @$pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($page->slug == 'course'): ?>
                                    <li class="footer-menu__item">
                                        <a href="<?php echo e(route('pages', [$page->slug])); ?>" class="footer-menu__link"><i
                                                class="fa-solid fa-angles-right"></i>
                                            <?php echo e($page->name); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li class="footer-menu__item"><a href="<?php echo e(url('/cookie-policy')); ?>"
                                    class="footer-menu__link"><i class="fa-solid fa-angles-right"></i>
                                    <?php echo app('translator')->get('Cookie Policy'); ?></a>
                            </li>
                            <?php if(@$general->agree == 1): ?>
                                <?php $__currentLoopData = @$policyElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="footer-menu__item">
                                        <a href="<?php echo e(route('policy.pages', [slug($element->data_values->title), $element->id])); ?>"
                                            class="footer-menu__link"><i class="fa-solid fa-angles-right"></i>
                                            <?php
                                                echo $element->data_values?->title;
                                            ?>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title"><?php echo app('translator')->get('Contact Us'); ?></h5>
                        <div class="footer-contact-info mb-3">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                            <p><a
                                    href="tel:<?php echo e($contactSection->data_values->mobile); ?>"><?php echo e(@$contactSection->data_values?->mobile); ?></a>
                            </p>
                        </div>
                        <div class="footer-contact-info mb-3">
                            <i class="fa-regular fa-envelope"></i>
                            <p><a
                                    href="mailto:<?php echo e(@$contactSection->data_values?->email); ?>"><?php echo app('translator')->get('Call us:'); ?><?php echo e(@$contactSection->data_values?->email); ?></a>
                            </p>
                        </div>
                        <ul class="social-list wow animate__animated animate__fadeInUp" data-wow-delay="1s">
                            <?php $__currentLoopData = $footerSectionElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="social-list__item">
                                    <a href="<?php echo e(@$item->data_values?->url); ?>" class="social-list__link icon-wrapper">
                                        <div class="icon">
                                            <?php
                                                echo @$item->data_values?->icon;
                                            ?>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title"><?php echo app('translator')->get('Newsletter'); ?></h5>
                        <p class="footer-item__desc">
                            <?php
                                echo @$footerSection->data_values?->short_description;
                            ?>
                        </p>
                        <div class="subscribe-box">
                            <form action="<?php echo e(route('subscribe')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input class="form--control footer-input" type="text"
                                    placeholder="<?php echo app('translator')->get('Email Address'); ?>">
                                <button class="sub-btn" type="submit"><i
                                        class="fa-regular fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Top End-->

    <!-- bottom Footer -->
    <div class="bottom-footer py-3">
        <div class="container">
            <div class="row text-center gy-2">
                <div class="col-lg-12">
                    <div class="bottom-footer-text">&copy; <?php echo app('translator')->get('Copyright'); ?> <?php echo e(now()->year); ?>

                        <?php echo app('translator')->get('. All rights reserved.'); ?></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ==================== Footer End Here ==================== -->
<?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/presets/default/components/footer.blade.php ENDPATH**/ ?>