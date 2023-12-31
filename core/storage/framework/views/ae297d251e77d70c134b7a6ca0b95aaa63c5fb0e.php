<?php
    $aboutUs = getContent('about.content', true);
    $aboutElement = getContent('about.element', null, false, true);
?>
<!-- about section start -->
<section class="pt-100 pb-100 border-bottom about-section" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section-header">
                    <div class="section-top-title text--base"><?php echo app('translator')->get('Welcome'); ?> <?php echo e(__($general->sitename)); ?></div>
                    <h2 class="section-title"><?php echo e(__(@$aboutUs->data_values->heading)); ?></h2>
                    <p><?php echo e(__(@$aboutUs->data_values->subheading)); ?></p>
                </div>
                <div class="row gy-4">
                    <?php $__currentLoopData = $aboutElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-8 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
                            <div class="info-card">
                                <div class="info-card__icon">
                                    <?php echo $about->data_values->icon; ?>
                                </div>
                                <div class="info-card__content">
                                    <h3 class="title"><?php echo e(__($about->data_values->title)); ?></h3>
                                    <p class="mt-2"><?php echo e(__($about->data_values->description)); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-lg-6 d-lg-block d-none">
                <div class="about-thumb">
                    <img src="<?php echo e(getImage('assets/images/frontend/about/' . @$aboutUs->data_values->about_image, '550x490')); ?>"
                        alt="About-Image">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about section end -->
<?php /**PATH /home/coalqjrb/public_html/core/resources/views/templates/basic/sections/about.blade.php ENDPATH**/ ?>