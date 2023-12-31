<?php
    $testimonial = getContent('testimonial.content', true);
    $testimonialElement = getContent('testimonial.element', null, false, true);
?>

<!-- testimonial section start -->
<section class="pt-50 pb-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title"><?php echo e(__(@$testimonial->data_values->heading)); ?></h2>
                    <p class="mt-3"><?php echo e(__(@$testimonial->data_values->subheading)); ?></p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="testimonial-slider">

            <?php $__currentLoopData = $testimonialElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="single-slide">
                    <div class="testimonial-item rounded-3">
                        <div class="ratings">

                            <?php for($i = 0; $i < @$item->data_values->number_of_star; $i++): ?>
                                <i class="las la-star"></i>
                            <?php endfor; ?>

                        </div>
                        <p class="mt-2 text-white"><?php echo e(__(@$item->data_values->comment)); ?></p>
                        <div class="client-details d-flex align-items-center mt-4">
                            <div class="thumb">
                                <img src="<?php echo e(getImage('assets/images/frontend/testimonial/' . @$item->data_values->image, '128x128')); ?>" alt="image">
                            </div>
                            <div class="content">
                                <h4 class="name text-white"><?php echo e(__(@$singleData->data_values->name)); ?></h4>
                                <span class="designation text-white-50 fs--14px">
                                    <?php echo e(__(@$singleData->data_values->designation)); ?>

                                </span>
                            </div>
                        </div>
                    </div><!-- testimonial-item end -->
                </div><!-- single-slide end -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div><!-- testimonial-slider end -->
    </div>
</section>
<!-- testimonial section end -->

<?php $__env->startPush('style-lib'); ?>
    <link href="<?php echo e(asset($activeTemplateTrue . 'css/slick.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-lib'); ?>
    <script src="<?php echo e(asset($activeTemplateTrue . 'js/slick.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict"

            /* ==============================
            					slider area
                    ================================= */

            // testimonial-slider
            $('.testimonial-slider').slick({
                autoplay: false,
                autoplaySpeed: 2000,
                dots: false,
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                arrows: false,
                slidesToScroll: 1,
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/coalqjrb/public_html/core/resources/views/templates/basic/sections/testimonial.blade.php ENDPATH**/ ?>