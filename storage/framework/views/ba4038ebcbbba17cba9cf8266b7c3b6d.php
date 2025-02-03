
<?php $__env->startSection('content'); ?>
<div class="login_area">
    <div class="login">
        <div class="login__header">
            <h2><?php echo e(__($pageTitle)); ?></h2>
            <p><?php echo e(__($general->site_name)); ?> <?php echo app('translator')->get('Dashboard'); ?></p>
        </div>
        <div class="login__body">
            <!-- <h4>user login</h4> -->
            <form action="<?php echo e(route('admin.login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="field">
                    <input type="text" name="username" placeholder="<?php echo app('translator')->get('Username'); ?>">
                    <span class="show-pass"><i class="fas fa-user"></i></span>
                </div>
                <div class="field">
                    <input type="password" name="password" placeholder="<?php echo app('translator')->get('Password'); ?>">
                    <span class="show-pass"><i class="fas fa-lock"></i></span>
                </div>
                <div class="login__footer">
                    <div class="field_remember">
                        <div class="remember_wrapper">
                            <input type="checkbox" name="remember" id="remember">
                            <label class="remember" for="remember"><?php echo app('translator')->get('Remember'); ?></label>
                        </div>
                    </div>
                    <div class="field_foget">
                        <a href="<?php echo e(route('admin.password.reset')); ?>"><?php echo app('translator')->get('Forgot password?'); ?></a>
                    </div>
                </div>
                <?php if (isset($component)) { $__componentOriginalff0a9fdc5428085522b49c68070c11d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff0a9fdc5428085522b49c68070c11d6 = $attributes; } ?>
<?php $component = App\View\Components\Captcha::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Captcha::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $attributes = $__attributesOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__attributesOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff0a9fdc5428085522b49c68070c11d6)): ?>
<?php $component = $__componentOriginalff0a9fdc5428085522b49c68070c11d6; ?>
<?php unset($__componentOriginalff0a9fdc5428085522b49c68070c11d6); ?>
<?php endif; ?>
                <div class="field">
                    <button type="submit" class="sign-in"><?php echo app('translator')->get('Sign in'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/auth.css')); ?>">
<style>
    .ball {
        position: absolute;
        border-radius: 100%;
        opacity: 0.7;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    "use strict";
    // Some random colors
    const colors = ["#00adad", "#e3e3e3", "red", "green", "blue"];

    const numBalls = 50;
    const balls = [];

    for (let i = 0; i < numBalls; i++) {
        let ball = document.createElement("div");
        ball.classList.add("ball");
        ball.style.background = colors[Math.floor(Math.random() * colors.length)];
        ball.style.left = `${Math.floor(Math.random() * 80)}vw`;
        ball.style.top = `${Math.floor(Math.random() * 80)}vh`;
        ball.style.transform = `scale(${Math.random()})`;
        ball.style.width = `${Math.random()}em`;
        ball.style.height = ball.style.width;

        balls.push(ball);
        document.body.append(ball);
    }

    // Keyframes
    balls.forEach((el, i, ra) => {
        let to = {
            x: Math.random() * (i % 2 === 0 ? -11 : 11),
            y: Math.random() * 12
        };

        let anim = el.animate(
            [
                { transform: "translate(0, 0)" },
                { transform: `translate(${to.x}rem, ${to.y}rem)` }
            ],
            {
                duration: (Math.random() + 1) * 2000, // random duration
                direction: "alternate",
                fill: "both",
                iterations: Infinity,
                easing: "ease-in-out"
            }
        );
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>