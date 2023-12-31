<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="">
                    <div class="mb-3 d-flex justify-content-end">
                        <div>
                            <div class="input-group">
                                <input type="search" name="search" value="<?php echo e(request()->search); ?>" class="form--control"
                                    placeholder="<?php echo app('translator')->get('Search by transactions'); ?>">
                                <button class="input-group-text bg--base border-0">
                                    <i class="la la-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table custom--table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('Gateway | Transaction'); ?></th>
                                <th><?php echo app('translator')->get('Initiated'); ?></th>
                                <th><?php echo app('translator')->get('Amount'); ?></th>
                                <th><?php echo app('translator')->get('Conversion'); ?></th>
                                <th><?php echo app('translator')->get('Status'); ?></th>
                                <th><?php echo app('translator')->get('Details'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <span class="fw-bold"> <span
                                                class="text--base"><?php echo e(__($deposit->gateway?->name)); ?></span>
                                        </span>
                                        <br>
                                        <small> <?php echo e($deposit->trx); ?> </small>
                                    </td>

                                    <td>
                                        <?php echo e(showDateTime($deposit->created_at)); ?><br><?php echo e(diffForHumans($deposit->created_at)); ?>

                                    </td>
                                    <td>
                                        <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($deposit->amount)); ?> + <span
                                            class="text--danger"
                                            title="<?php echo app('translator')->get('charge'); ?>"><?php echo e(showAmount($deposit->charge)); ?> </span>
                                        <br>
                                        <strong title="<?php echo app('translator')->get('Amount with charge'); ?>">
                                            <?php echo e(showAmount($deposit->amount + $deposit->charge)); ?>

                                            <?php echo e(__($general->cur_text)); ?>

                                        </strong>
                                    </td>
                                    <td>
                                        1 <?php echo e(__($general->cur_text)); ?> = <?php echo e(showAmount($deposit->rate)); ?>

                                        <?php echo e(__($deposit->method_currency)); ?>

                                        <br>
                                        <strong><?php echo e(showAmount($deposit->final_amo)); ?>

                                            <?php echo e(__($deposit->method_currency)); ?></strong>
                                    </td>
                                    <td>
                                        <?php echo $deposit->statusBadge ?>
                                    </td>
                                    <?php
                                        $details = $deposit->detail != null ? json_encode($deposit->detail) : null;
                                    ?>
                                    <td>
                                        <a href="javascript:void(0)"
                                            class="btn btn--base btn-sm <?php if($deposit->method_code >= 1000): ?> detailBtn <?php else: ?> disabled <?php endif; ?>"
                                            <?php if($deposit->method_code >= 1000): ?> data-info="<?php echo e($details); ?>" <?php endif; ?>
                                            <?php if($deposit->status == Status::PAYMENT_REJECT): ?> data-admin_feedback="<?php echo e($deposit->admin_feedback); ?>" <?php endif; ?>>
                                            <i class="la la-desktop"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="100%" class="text-center"><?php echo e(__($emptyMessage)); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if($deposits->hasPages()): ?>
                      <?php echo e(paginateLinks($deposits)); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Details'); ?></h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal">
                        <i class="la la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group userData mb-2">
                    </ul>
                    <div class="feedback"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--sm btn--base" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');

                var userData = $(this).data('info');
                var html = '';
                if (userData) {
                    userData.forEach(element => {
                        if (element.type != 'file') {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${element.name}</span>
                                <span">${element.value}</span>
                            </li>`;
                        }
                    });
                }

                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3">
                            <?php echo app('translator')->get('Admin Feedback'); ?>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }

                modal.find('.feedback').html(adminFeedback);

                modal.modal('show');
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/coalqjrb/public_html/core/resources/views/templates/basic/user/deposit_history.blade.php ENDPATH**/ ?>