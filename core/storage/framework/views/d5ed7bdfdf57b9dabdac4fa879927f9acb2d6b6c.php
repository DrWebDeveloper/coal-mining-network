<?php
    $banner = getContent('banner.content', true);
    $breadcrumb = getContent('breadcrumb.content', true);
?>

<!-- hero section start -->

<section class="inner-hero bg_img overlay--one"
    style="background-image: url('<?php echo e(getImage('assets/images/frontend/breadcrumb/' . @$breadcrumb->data_values->image, '1920x1280')); ?>');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="page-title text-white"><?php echo e(__($pageTitle)); ?></h2>
                <ul class="page-breadcrumb justify-content-center">
                    <li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                    <li><?php echo e(__($pageTitle)); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- hero section end -->
<?php /**PATH /home/coalqjrb/public_html/core/resources/views/templates/basic/partials/breadcrumb.blade.php ENDPATH**/ ?>