<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Limit Amount'); ?></th>
                                    <th><?php echo app('translator')->get('Returns'); ?></th>
                                    <th><?php echo app('translator')->get('Type'); ?></th>
                                    <th><?php echo app('translator')->get('Interest'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($plans->firstItem() + $loop->index); ?></td>
                                        <td><?php echo e(__($plan->name)); ?></td>
                                        <td>
                                            <?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->min_amount)); ?> -
                                            <?php echo e($general->cur_sym); ?><?php echo e(showAmount($plan->max_amount)); ?>

                                        </td>

                                        <td>
                                            <?php echo e($plan->total_return); ?> <?php echo app('translator')->get('Times'); ?>
                                        </td>

                                        <td>
                                            <?php if($plan->interest_type == Status::PERCENT): ?>
                                            (%)<?php echo app('translator')->get('Percent'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('Fixed'); ?>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if($plan->interest_type == Status::PERCENT): ?>
                                                <?php echo e(showAmount($plan->interest)); ?>%
                                            <?php else: ?>
                                               <?php echo e(showAmount($plan->interest)); ?> <?php echo e($general->cur_text); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php echo $plan->statusBadge ?>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline--primary isEdit cuModalBtn"
                                                data-resource="<?php echo e($plan); ?>" data-modal_title="<?php echo app('translator')->get('Edit Plan'); ?>"
                                                data-has_status="1">
                                                <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                            </button>
                                            <?php if($plan->status == Status::DISABLE): ?>
                                            <button type="button"
                                                    class="btn btn-sm btn-outline--success confirmationBtn"
                                                    data-action="<?php echo e(route('admin.plan.status', $plan->id)); ?>"
                                                    data-question="<?php echo app('translator')->get('Are you sure to enable this plan?'); ?>">
                                                <i class="la la-eye"></i> <?php echo app('translator')->get('Enable'); ?>
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-sm btn-outline--danger confirmationBtn"
                                            data-action="<?php echo e(route('admin.plan.status', $plan->id)); ?>"
                                            data-question="<?php echo app('translator')->get('Are you sure to disable this plan?'); ?>">
                                                    <i class="la la-eye-slash"></i> <?php echo app('translator')->get('Disable'); ?>
                                            </button>
                                        <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <?php if($plans->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo paginateLinks($plans) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!--Cu Modal -->
    <div id="cuModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.plan.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Name'); ?></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Minimum'); ?></label>
                                    <div class="input-group">
                                        <input type="number" name="min_amount" class="form-control" required>
                                        <button type="button" class="input-group-text"><?php echo e($general->cur_text); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Maximum'); ?></label>
                                    <div class="input-group">
                                        <input type="number" name="max_amount" class="form-control" required>
                                        <button type="button" class="input-group-text"><?php echo e($general->cur_text); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('How Many Return'); ?></label>
                            <div class="input-group">
                                <input type="number" name="total_return" class="form-control" required>
                                <button type="button" class="input-group-text"><?php echo app('translator')->get('Times'); ?></button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Interest Type'); ?></label>
                            <div class="input-group">
                                <select name="interest_type" class="form-control" required>
                                    <option value="1"><?php echo app('translator')->get('Percent'); ?></option>
                                    <option value="2"><?php echo app('translator')->get('Fixed'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group percent">
                            <label class="type-label"><?php echo app('translator')->get('Percent Amount'); ?></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="interest" value="<?php echo e(old('interest')); ?>" autocomplete="off" />
                                <button type="button" class="input-group-text">
                                    <span class="percent-sym">%</span>
                                    <span class="fixed-sym d-none"><?php echo e($general->cur_text); ?></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b)): ?>
<?php $component = $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b; ?>
<?php unset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Search by name here...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Search by name here...']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <button type="button" class="btn btn-sm btn-outline--primary h-45 cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add Plan'); ?>">
        <i class="la la-plus"></i><?php echo app('translator')->get('Add New'); ?>
    </button>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";

            function typeMaintence(interestType) {
                if (interestType == 2) {
                    $('.type-label').text(`<?php echo app('translator')->get('Fixed Amount'); ?>`);
                    $('.fixed-sym').removeClass('d-none');
                    $('.percent-sym').addClass('d-none');
                } else {
                    $('.type-label').text(`<?php echo app('translator')->get('Percent Amount'); ?>`);
                    $('.fixed-sym').addClass('d-none');
                    $('.percent-sym').removeClass('d-none');
                }
            }

            //add
            $('[name=interest_type]').on('change', function() {
                let interestType = $(this).find(':selected').val();

                typeMaintence(interestType)
            });

            //edit
            $('.isEdit').on('click', function() {
                let interestType = $(this).data('resource').interest_type;

                typeMaintence(interestType)
            })

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/coalqjrb/public_html/core/resources/views/admin/plan/index.blade.php ENDPATH**/ ?>