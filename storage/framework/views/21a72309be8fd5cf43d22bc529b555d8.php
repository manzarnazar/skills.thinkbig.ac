<script>
    (function($) {
        "use strict";
        $(".langSel").on("change", function() {
            window.location.href = "<?php echo e(route('home')); ?>/change/" + $(this).val();
        });

        $('.policy').on('click', function() {
            $.get('<?php echo e(route('cookie.accept')); ?>', function(response) {
                $('.cookies-card').addClass('d-none');
            });
        });

        setTimeout(function() {
            $('.cookies-card').removeClass('hide')
        }, 2000);


        $.each($('input, select, textarea'), function(i, element) {

            if (element.hasAttribute('required')) {
                $(element).closest('.form-group').find('label').addClass('required');
            }

        });

    })(jQuery);
</script><?php /**PATH /home/thingpfd/learn.thinkbig.ac/application/resources/views/includes/language_js.blade.php ENDPATH**/ ?>