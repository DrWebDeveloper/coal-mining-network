
<?php
$faq = getContent('faq.content', true);
$faqElement = getContent('faq.element',null,false,true);
?>

<!-- faq section start -->
<section class="pt-100 pb-50" id="faq">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="section-header text-center">
            <h2 class="section-title"><?php echo e(__(@$faq->data_values->heading)); ?></h2>
          </div>
        </div>
      </div>
      <div class="row align-items-center justify-content-between gy-4">
        <div class="accordion custom--accordion" id="faqAccordion">
          <div class="row gy-4">

        <?php $__currentLoopData = $faqElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-6">
              <div class="accordion-item">
                <h2 class="accordion-header" id="h-<?php echo e($item->id); ?>">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c-<?php echo e($item->id); ?>" aria-expanded="false" aria-controls="c-<?php echo e($item->id); ?>">
                    <?php echo e(__($item->data_values->question)); ?>

                  </button>
                </h2>
                <div id="c-<?php echo e($item->id); ?>" class="accordion-collapse collapse" aria-labelledby="h-<?php echo e($item->id); ?>" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    <p><?php echo  __($item->data_values->answer) ?></p>
                  </div>
                </div>
              </div><!-- accordion-item-->
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- faq section end -->
<?php /**PATH /home/coalqjrb/public_html/core/resources/views/templates/basic/sections/faq.blade.php ENDPATH**/ ?>