<?php
    $overviews = getContent('overview.element',null,false,true);
?>

<!-- overview section start -->
<div class="overview-section pb-50">
    <div class="container">
        <div class="row gy-sm-0 gy-4 overview-wrapper wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <?php $__currentLoopData = $overviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-4 overview-item">
                    <div class="overview-card">
                        <div class="overview-card__icon">
                        <?php echo $overview->data_values->icon; ?>
                        </div>
                        <div class="overview-card__content">
                        <h3 class="amount text--base text-shadow--base"><?php echo e($overview->data_values->text); ?></h3>
                        <p><?php echo e(__($overview->data_values->title)); ?></p>
                        </div>
                    </div>
                </div><!-- overview-item end -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    </div>
    <!-- overview section end -->
<?php /**PATH /home/coalqjrb/public_html/core/resources/views/templates/basic/sections/overview.blade.php ENDPATH**/ ?>