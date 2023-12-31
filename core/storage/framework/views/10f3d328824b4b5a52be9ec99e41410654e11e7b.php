<?php
    $socialIcons = getContent('social_icon.element', false, null, true);
    $policyPages = getContent('policy_pages.element');
?>
<!-- footer start -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-2 col-md-3 text-md-start text-center">
                <a href="<?php echo e(route('home')); ?>" class="footer-logo"><img
                        src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>"" alt="image"></a>
            </div>
            <div class="col-lg-10 col-md-9 mt-md-0 mt-3">
                <ul class="inline-menu d-flex flex-wrap justify-content-md-end justify-content-center align-items-center">
                    <li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                    <?php $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('policy.pages', ['slug'=> slug($policy->data_values->title), 'id'=>$policy->id])); ?>"><?php echo e(__($policy->data_values->title)); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div><!-- row end -->
        <hr class="mt-3">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center">
                <span class="footer-content__left-text"> &copy; <?php echo app('translator')->get('Copyright'); ?>
                    <?php echo e(\Carbon\Carbon::now()->format('Y')); ?>. <?php echo app('translator')->get('All Right Reserved'); ?> 
                    <a class="text--base" href="<?php echo e(route('home')); ?>"><?php echo e(@$general->site_name); ?>.</a> 
                </span>
            </div>

            <div class="col-md-6 mt-md-0 mt-3">
                <ul class="inline-social-links d-flex align-items-center justify-content-md-end justify-content-center">
                    <?php $__currentLoopData = $socialIcons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e($icon->data_values->url); ?>" target="_blank"> <?php echo $icon->data_values->social_icon; ?> </a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->
<?php /**PATH /Users/umar/Sites/localhost/coal-mining-network/core/resources/views/templates/basic/partials/footer.blade.php ENDPATH**/ ?>