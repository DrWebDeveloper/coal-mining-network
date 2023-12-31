<!-- Confirmation Modal -->
<div class="modal fade conf" id="ConfirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="loginModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="ConfirmationModalLabel"><?php echo app('translator')->get('Confirmation'); ?>!</h3>
            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                <i class="las la-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form class="account-form login-form">
                <div class="form-group">
                    <h4 class="text-center p-2"><?php echo app('translator')->get('Are you sure to Logout'); ?>?</h4>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <button type="button" class="btn w-100 bg-danger text-white"
                            data-bs-dismiss="modal"><?php echo app('translator')->get('Cancel'); ?></button>
                    </div>
                    <div class="col-lg-6">
                        <a href="<?php echo e(route('user.logout')); ?>"
                            class="btn btn--base w-100"><?php echo app('translator')->get('Logout'); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div><?php /**PATH /home/coalqjrb/public_html/core/resources/views/components/logout-confirmation.blade.php ENDPATH**/ ?>