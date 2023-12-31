<?php $__env->startSection('content'); ?>
<?php
    $banner     = getContent('banner.content', true);
?>

<!-- hero section start -->

    <section class="hero bg_img" style="background-image: url('<?php echo e(getImage( 'assets/images/frontend/banner/' .@$banner->data_values->image, '1920x1280')); ?>');">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-8 col-lg-10 text-center">
                <h2 class="hero__title wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s"><?php echo e(__(@$banner->data_values->heading)); ?></h2>
                <p class="hero__description mt-3 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s"><?php echo e(__(@$banner->data_values->subheading)); ?></p>

                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('user.home')); ?>" class="btn btn--base btn--capsule mt-4 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s"><?php echo app('translator')->get('Get Started'); ?></a>
                <?php else: ?>
                    <a href="#0" class="btn btn--base btn--capsule mt-4 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s" data-bs-toggle="modal" data-bs-target="#registerModal"><?php echo app('translator')->get('Get Started'); ?></a>
                <?php endif; ?>
            </div>
            </div>
        </div>
    </section>
  
    <!-- hero section end -->

    <?php if($sections->secs != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate.'sections.'.$sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make($activeTemplate.'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/coalqjrb/public_html/core/resources/views/templates/basic/home.blade.php ENDPATH**/ ?>