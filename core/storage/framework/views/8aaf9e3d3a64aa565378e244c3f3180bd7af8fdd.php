<?php
    $kyc = getContent('kyc_info.content', true);
?>

<?php $__env->startSection('content'); ?>
    <!-- dashboard section start -->
    <section class="py-5">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-12 mb-30">
                    <?php if(auth()->user()->kv == Status::KYC_UNVERIFIED): ?>
                        <div class="alert alert-danger package-card text--danger border" role="alert">
                            <h4 class="alert-heading"><?php echo app('translator')->get('KYC Verification required'); ?></h4>
                            <hr>
                            <p class="mb-0"><?php echo e(__(@$kyc->data_values->verification_instruction)); ?>

                                <a class="text--base" href="<?php echo e(route('user.kyc.form')); ?>"><?php echo app('translator')->get('Click Here to Verify'); ?></a>
                            </p>
                        </div>
                    <?php elseif(auth()->user()->kv == Status::KYC_PENDING): ?>
                        <div class="alert alert-warning package-card text--warning border" role="alert">
                            <h4 class="alert-heading"><?php echo app('translator')->get('KYC Verification pending'); ?></h4>
                            <hr>
                            <p class="mb-0"><?php echo e(__(@$kyc->data_values->pending_instruction)); ?>

                                <a class="text--base" href="<?php echo e(route('user.kyc.data')); ?>"><?php echo app('translator')->get('See KYC Data'); ?></a>
                            </p>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="col-lg-12 mb-30">

                    <?php echo $__env->make($activeTemplate . 'partials.referral_link', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </div>

                <div class="col-lg-3 col-sm-6">
                    <a class="d-block" href="<?php echo e(route('user.transactions')); ?>">
                        <div class="balance-card">
                            <span class="text--dark"><?php echo app('translator')->get('Total Balance'); ?></span>
                            <h3 class="number text--dark">
                                <?php echo e($general->cur_sym . showAmount($user->balance)); ?>

                            </h3>
                        </div><!-- dashboard-card end -->
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-card">
                        <span><?php echo app('translator')->get('Total Deposit'); ?></span>
                        <a class="view--btn" href="<?php echo e(route('user.deposit.history')); ?>"><?php echo app('translator')->get('View all'); ?></a>
                        <h3 class="number">
                            <?php echo e($general->cur_sym . showAmount($totalDeposit)); ?>

                        </h3>
                        <i class="las la-dollar-sign icon"></i>
                    </div><!-- dashboard-card end -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-card">
                        <span><?php echo app('translator')->get('Total Withdraw'); ?></span>
                        <a class="view--btn" href="<?php echo e(route('user.withdraw.history')); ?>"><?php echo app('translator')->get('View all'); ?></a>
                        <h3 class="number">
                            <?php echo e($general->cur_sym . showAmount($totalWithdraw)); ?>

                        </h3>
                        <i class="las la-hand-holding-usd icon"></i>
                    </div><!-- dashboard-card end -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-card">
                        <span><?php echo app('translator')->get('Total Investment'); ?></span>
                        <a class="view--btn" href="<?php echo e(route('user.investment.log')); ?>"><?php echo app('translator')->get('View all'); ?></a>
                        <h3 class="number">
                            <?php echo e($general->cur_sym . showAmount($totalInvest)); ?>

                        </h3>
                        <i class="las la-dollar-sign icon"></i>
                    </div><!-- dashboard-card end -->
                </div>
            </div><!-- row end -->
            <div class="row justify-content-center gx-4 gy-5 mt-5">

                <!-- Here Attach Plans cardfrom view partial blade  -->
                <?php echo $__env->make('partials.plans_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
            <div class="row mt-5">
                <div class="col-lg-12">

                    <div class="table-responsive--md">
                        <h4 class="mb-3"><?php echo app('translator')->get('Latest Transactions'); ?></h4>
                        <table class="custom--table table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Trx'); ?></th>
                                    <th><?php echo app('translator')->get('Transacted'); ?></th>
                                    <th><?php echo app('translator')->get('Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Charge'); ?></th>
                                    <th><?php echo app('translator')->get('Post Balance'); ?></th>
                                    <th><?php echo app('translator')->get('Detail'); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = $latestTrx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($data->trx); ?></td>
                                        <td>
                                            <?php echo e(showDateTime($data->created_at)); ?></td>

                                        <td class="budget">
                                            <span
                                                class="fw-bold <?php if($data->trx_type == '+'): ?> text-success <?php else: ?> text-danger <?php endif; ?>">
                                                <?php echo e($data->trx_type); ?> <?php echo e(showAmount($data->amount)); ?>

                                                <?php echo e($general->cur_text); ?>

                                            </span>
                                        </td>

                                        <td><?php echo e(showAmount($data->charge)); ?> <?php echo e(__($general->cur_text)); ?></td>
                                        <td class="budget">
                                            <?php echo e(showAmount($data->post_balance)); ?> <?php echo e(__($general->cur_text)); ?>

                                        </td>
                                        <td><?php echo e(__($data->details)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="100%" class="text-center"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- dashboard section end -->

        <!-- Here is Buying Plan Modal Component  -->
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.plan-modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('plan-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/umar/Sites/localhost/coal-mining-network/core/resources/views/templates/basic/user/dashboard.blade.php ENDPATH**/ ?>