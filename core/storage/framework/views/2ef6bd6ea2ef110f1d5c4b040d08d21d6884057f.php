    <!-- header-section start  -->
    <header class="header">
        <div class="header__bottom">
            <div class="container-fluid px-lg-5">
                <nav class="navbar navbar-expand-xl align-items-center p-0">
                    <a class="site-logo site-title" href="<?php echo e(route('home')); ?>"><img
                            src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="logo"></a>
                    <button class="navbar-toggler header-button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu-toggle"></span>
                    </button>
                    <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
                        <ul class="navbar-nav main-menu me-auto">
                            <li><a class="<?php echo e(menuActive('user.home')); ?>" href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?></a></li>

                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive('user.deposit.*')); ?>" href="#0"><?php echo app('translator')->get('Deposit'); ?></a>
                                <ul class="sub-menu" style="background: #20204E;">
                                    <li><a href="<?php echo e(route('user.deposit.index')); ?>"><?php echo app('translator')->get('Deposit Money'); ?></a></li>
                                    <li><a href="<?php echo e(route('user.deposit.history')); ?>"><?php echo app('translator')->get('Deposit History'); ?></a></li>
                                </ul>
                            </li>

                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive('user.withdraw.*')); ?>" href="#0"><?php echo app('translator')->get('Withdraw'); ?></a>
                                <ul class="sub-menu" style="background: #20204E;">
                                    <li><a href="<?php echo e(route('user.withdraw')); ?>"><?php echo app('translator')->get('Withdraw Money'); ?></a></li>
                                    <li><a href="<?php echo e(route('user.withdraw.history')); ?>"><?php echo app('translator')->get('Withdraw History'); ?></a></li>
                                </ul>
                            </li>

                            <li>
                                <a class="<?php echo e(menuActive('user.referrals')); ?>" href="<?php echo e(route('user.referrals')); ?>"><?php echo app('translator')->get('Referrals'); ?></a>
                            </li>

                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive(['user.plans', 'user.investment.log'])); ?>" href="#0"><?php echo app('translator')->get('Investment'); ?></a>
                                <ul class="sub-menu" style="background: #20204E;">
                                    <li><a href="<?php echo e(route('user.plans')); ?>"><?php echo app('translator')->get('Plans'); ?></a></li>
                                    <li><a href="<?php echo e(route('user.investment.log')); ?>"><?php echo app('translator')->get('Investment Log'); ?></a></li>
                                </ul>
                            </li>

                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive('ticket.*')); ?>" href="#0"><?php echo app('translator')->get('Support'); ?></a>
                                <ul class="sub-menu" style="background: #20204E;">
                                    <li><a href="<?php echo e(route('ticket.index')); ?>"><?php echo app('translator')->get('My Support Tickets'); ?></a></li>
                                    <li><a href="<?php echo e(route('ticket.open')); ?>"><?php echo app('translator')->get('New Support Ticket'); ?></a></li>
                                </ul>
                            </li>

                            <li class="menu_has_children">
                                <a class="<?php echo e(menuActive(['user.profile.setting', 'user.twofactor', 'user.change.password', 'user.change.password'])); ?> href="#0"><?php echo app('translator')->get('Account'); ?></a>
                                <ul class="sub-menu" style="background: #20204E;">
                                    <li><a href="<?php echo e(route('user.profile.setting')); ?>"><?php echo app('translator')->get('Profile'); ?></a></li>
                                    <li><a href="<?php echo e(route('user.change.password')); ?>"><?php echo app('translator')->get('Change Password'); ?></a></li>
                                    <li><a href="<?php echo e(route('user.transactions')); ?>"><?php echo app('translator')->get('Transaction Log'); ?></a></li>
                                    <li><a href="<?php echo e(route('user.twofactor')); ?>"><?php echo app('translator')->get('2FA Security'); ?></a></li>
                                    <li><a href="<?php echo e(route('user.logout')); ?>"><?php echo app('translator')->get('Logout'); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="nav-right">

                            <a class="btn btn-sm btn--base me-3 btn--capsule px-3" data-bs-toggle="modal" data-bs-target="#ConfirmationModal" href="#0"><?php echo app('translator')->get('Logout'); ?>
                            </a>

                            <?php if($general->lang): ?>
                                <select class="language-select langSel">
                                    <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->code); ?>" <?php if(session('lang') == $item->code): ?> selected <?php endif; ?>>
                                            <?php echo e(__($item->name)); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>

                        </div>
                    </div>
                </nav>
            </div>
        </div><!-- header__bottom end -->
    </header>
    <!-- header-section end  -->
<?php /**PATH /Users/umar/Sites/localhost/coal-mining-network/core/resources/views/templates/basic/partials/auth_header.blade.php ENDPATH**/ ?>