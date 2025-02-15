<?php $__env->startSection('content'); ?>
<div style="background-image: url('<?php echo e(asset('assets/admin/images/login.png')); ?>')" class="login_area">
    <div class="login">
        <div class="login__header">
            <h2><?php echo app('translator')->get('Recover Account'); ?></h2>
            <p><?php echo app('translator')->get('We will sent an email to recover your account'); ?></p>
        </div>
        <div class="login__body">
            <!-- <h4>user login</h4> -->
            <form action="<?php echo e(route('admin.password.reset')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="field">
                    <input type="email" name="email" placeholder="<?php echo app('translator')->get('Email'); ?>" value="<?php echo e(old('email')); ?>" required>
                    <span class="show-pass"><i class="fas fa-envelope"></i></span>
                </div>
                <div class="field">
                    <button type="submit" class="sign-in"><?php echo app('translator')->get('Send Email'); ?></button>
                </div>
                <div class="login__footer d-flex justify-content-center">
                    <a class="float-end" href="<?php echo e(route('admin.login')); ?>"><?php echo app('translator')->get('Go back'); ?></a>
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
        const colors = ["#BADA55", "#E3E3E3", "red", "green", "blue"];
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/admin/auth/passwords/email.blade.php ENDPATH**/ ?>