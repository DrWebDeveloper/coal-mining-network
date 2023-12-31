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
                        <ul class="navbar-nav main-menu me-auto" id="linkItem">
                            <li><a class="<?php echo e(menuActive('home')); ?>" href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                            <li><a href="#about"><?php echo app('translator')->get('About'); ?></a></li>
                            <li><a href="#plan"><?php echo app('translator')->get('Plan'); ?></a></li>
                            <li><a href="#feature"><?php echo app('translator')->get('Feature'); ?></a></li>
                            <li><a href="#faq"><?php echo app('translator')->get('Faq'); ?></a></li>
                            <li><a href="#gateway"><?php echo app('translator')->get('Gateway'); ?></a></li>
                            <?php
                                $pages = App\Models\Page::where('tempname', $activeTemplate)
                                    ->where('is_default', Status::NO)
                                    ->get();
                            ?>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('pages', [$data->slug])); ?>">
                                        <?php echo e(__($data->name)); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if(auth()->guard()->check()): ?>
                                <li><a class="<?php echo e(menuActive('ticket.open')); ?>" href="<?php echo e(route('ticket.open')); ?>"><?php echo app('translator')->get('Support'); ?></a></li>
                            <?php else: ?>
                                <li><a class="<?php echo e(menuActive('contact')); ?>" href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a></li>
                            <?php endif; ?>
                        </ul>
                        <div class="nav-right">

                            <?php if(auth()->guard()->check()): ?>
                                <a class="btn btn-sm btn--base me-3 btn--capsule px-3" href="<?php echo e(route('user.home')); ?>">
                                    <?php echo app('translator')->get('Dashboard'); ?>
                                </a>

                                <?php if(request()->routeIs('user.authorization')): ?>
                                    <button class="btn btn-sm btn--base me-3 btn--capsule px-3" data-bs-toggle="modal" data-bs-target="#ConfirmationModal" type="button"><?php echo app('translator')->get('Logout'); ?>
                                    </button>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="btn btn-sm btn--base me-3 btn--capsule px-3" data-bs-toggle="modal" data-bs-target="#loginModal" href="#0"><?php echo app('translator')->get('Login'); ?></a>

                                <a class="fs--14px me-3 text-white" id="open-registration-modal" data-bs-toggle="modal" data-bs-target="#registerModal" href="#0"><?php echo app('translator')->get('Register'); ?></a>
                                <!-- Button trigger modal -->

                            <?php endif; ?>

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

    <?php if(request()->routeIs('user.authorization')): ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.logout-confirmation','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('logout-confirmation'); ?>
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
    <?php endif; ?>
<?php /**PATH /home/coalqjrb/public_html/core/resources/views/templates/basic/partials/header.blade.php ENDPATH**/ ?>