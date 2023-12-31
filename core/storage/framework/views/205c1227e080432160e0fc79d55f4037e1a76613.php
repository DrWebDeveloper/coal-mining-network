<?php $__env->startSection('panel'); ?>
    <?php echo $__env->make($activeTemplate . 'partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(auth()->guard()->guest()): ?>
        <?php echo $__env->make($activeTemplate . 'partials.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <div class="main-wrapper">
        <?php if(!request()->routeIs('home')): ?>
            <?php echo $__env->make($activeTemplate . 'partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php
        $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    ?>
    <?php if($cookie->data_values->status == Status::ENABLE && !\Cookie::get('gdpr_cookie')): ?>
        <!-- cookies dark version start -->
        <div class="cookies-card hide text-center">
            <div class="cookies-card__icon bg--base">
                <i class="las la-cookie-bite"></i>
            </div>
            <p class="cookies-card__content mt-4"><?php echo e(__($cookie->data_values->short_desc)); ?> <a
                    class="text--base" href="<?php echo e(route('cookie.policy')); ?>" target="_blank"><?php echo app('translator')->get('learn more'); ?></a></p>
            <div class="cookies-card__btn mt-4">
                <a class="btn btn--base w-100 policy" href="javascript:void(0)"><?php echo app('translator')->get('Allow'); ?></a>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            //Start-Id-Wise-Route-set
            let currentRoute = '<?php echo e(Route::currentRouteName()); ?>'
            let sectionArray = ['#about', '#plan', '#feature', '#faq', '#gateway'];
            if (currentRoute != 'home') {
                let links = $('#linkItem a');
                links.on('click', function() {
                    let section = $(this).attr('href');
                    let base = '<?php echo e(route('home')); ?>';
                    if (sectionArray.includes(section)) {
                        window.location = base + section;
                    }
                });
            }
            //End-Id-Wise-Route-set

            $('.policy').on('click', function() {
                $.get('<?php echo e(route('cookie.accept')); ?>', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/umar/Sites/localhost/coal-mining-network/core/resources/views/templates/basic/layouts/frontend.blade.php ENDPATH**/ ?>