
<?php
$feature = getContent('feature.content', true);
$featureElement = getContent('feature.element',null,false,true);
?>

<!-- feature section start -->
<section class="pt-100 pb-100 section--bg border-top border-bottom" id="feature">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-header">
            <h2 class="section-title"><?php echo e(__(@$feature->data_values->heading)); ?></h2>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row justify-content-center gy-4">
        <?php $__currentLoopData = $featureElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
                <div class="feature-card rounded-3">
                    <div class="feature-card__icon text--base text-shadow--base">
                        <?php echo $item->data_values->feature_icon; ?>
                    </div>
                    <div class="feature-card__content mt-4">
                        <h3 class="title"><?php echo e(__(@$item->data_values->title)); ?></h3>
                        <p class="mt-3"><?php echo e(__(@$item->data_values->description)); ?></p>
                    </div>
                </div><!-- feature-card end -->
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
    </div>
  </section>
  <!-- feature section end -->

<?php /**PATH /home/coalqjrb/public_html/core/resources/views/templates/basic/sections/feature.blade.php ENDPATH**/ ?>