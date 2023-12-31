<?php
    $plans = App\Models\Plan::where('status', Status::ENABLE)
        ->limit(12)
        ->get();
?>

<?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-xl-3 col-lg-4 col-sm-6 mb-70 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
        <div class="package-card text-center bg_img"
            style="background-image: url('<?php echo e(asset($activeTemplateTrue . 'images/bg/plan.jpg')); ?>');">
            <h4 class="package-card__title"><?php echo e(__($plan->name)); ?></h4>
            <div class="package-card__range mt-4 base--color">
                <?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->min_amount, 0)); ?>

                -
                <?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->max_amount, 0)); ?>

            </div>
            <ul class="package-card__features mt-3">
                <li>
                    <?php echo app('translator')->get('Return'); ?>
                    <?php echo e(showAmount($plan->interest, 0)); ?><?php echo e($plan->interest_type == Status::FIXED ? ' ' . $general->cur_text : '%'); ?>

                </li>
                <li><?php echo app('translator')->get('Every Day'); ?></li>
                <li><?php echo app('translator')->get('For'); ?> <?php echo e($plan->total_return); ?> <?php echo app('translator')->get('Times'); ?></li>
            </ul>
            <a href="#0" data-name="<?php echo e(__($plan->name)); ?>" data-id="<?php echo e($plan->id); ?>"
                class="btn btn-md btn--base mt-4 planModal" data-bs-toggle="modal"
                data-bs-target="<?php echo e(Auth::user() ? '#planModal' : '#loginModal'); ?>">
                <?php echo app('translator')->get('Invest Now'); ?>
            </a>
        </div><!-- package-card end -->
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <h2 class="text-center">
        <div class="alert dashboard-card" role="alert">
            <?php echo app('translator')->get('Plan does not found'); ?>
        </div>
    </h2>
<?php endif; ?>

<?php if(auth()->guard()->check()): ?>
    <?php if($plans->count() > 12): ?>
        <div class="text-center">
            <a href="<?php echo e(route('user.plans')); ?>" class="btn btn--base btn--capsule" data-wow-duration="0.5s"
                data-wow-delay="0.7s"><?php echo app('translator')->get('View All'); ?></a>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/coalqjrb/public_html/core/resources/views/partials/plans_card.blade.php ENDPATH**/ ?>