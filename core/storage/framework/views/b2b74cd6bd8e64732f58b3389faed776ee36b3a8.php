<div class="form-group">
    <label><?php echo app('translator')->get('Referral Link'); ?></label>
    <div class="input-group">
        <input type="text" class="form--control border" id="referralURL"
            value="<?php echo e(route('home')); ?>?reference=<?php echo e(auth()->user()->username); ?>" readonly>
        <div class="input-group-text bg--base">
            <span class="copytext copyBoard" id="copyBoard"> <i class="la la-copy"></i> </span>
        </div>
    </div>
</div>


<?php $__env->startPush('style'); ?>
    <style type="text/css">
        #copyBoard {
            cursor: pointer;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";


            $('.copyBoard').click(function() {
                "use strict";
                var copyText = document.getElementById("referralURL");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                iziToast.success({
                    message: "Copied: " + copyText.value,
                    position: "topRight"
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?><?php /**PATH /Users/umar/Sites/localhost/coal-mining-network/core/resources/views/templates/basic/partials/referral_link.blade.php ENDPATH**/ ?>