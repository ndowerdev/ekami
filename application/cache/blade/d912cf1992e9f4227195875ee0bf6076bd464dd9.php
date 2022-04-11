<?php      
    $related        = collect($random_related);
    $sentences      = collect($sentences);
    $images         = collect($images);    
    $image          = $images->shuffle()->shift();
    $max_image      = MAX_IMAGE_RESULT;
    $ads_link       = ADS_LINK;
    $cover_img      = blade_image($keyword,TRUE);
    //$cover_img      = cdn_image($image['url']);
?>

<?php $__env->startSection('title'); ?>
<?php echo e(imake_stringcase("ucwords", $keyword)); ?> at <?php echo e(imake_stringcase("ucwords", $niche)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
<?php echo $__env->make('json_id', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="preconnect" href="https://i2.wp.com">
<link rel="dns-prefetch" href="https://i2.wp.com">
<link rel="preconnect" href="https://i.pinimg.com">
<link rel="dns-prefetch" href="https://i.pinimg.com">
<link rel="preload" href="<?php echo e($cover_img); ?>" as="image" media="(max-width: 420px)">
<link rel="preload" href="<?php echo e($cover_img); ?>" as="image" media="(min-width: 420.1px)" >
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<article>
    <p><strong><?php echo e(imake_stringcase("ucwords", $keyword)); ?></strong>. <?php echo e($sentences->shuffle()->take(2)->implode(' ')); ?></p>
    <?php if($image): ?>
    <figure>
        <img class="img-fluid mx-auto d-block ads-img" src="<?php echo e($cover_img); ?>" alt="<?php echo e($image['title']); ?>" />
        <br>
        <figcaption><?php echo e($image['title']); ?> from <?php echo e($image['domain']); ?></figcaption>
    </figure>
    <?php endif; ?>
    <p>
        <?php echo e($sentences->shuffle()->take(3)->implode(' ')); ?>

    </p>
    <h3><?php echo e($image['title']); ?></h3>
    <p><?php echo e($sentences->shuffle()->pop()); ?> <?php echo e($sentences->shuffle()->take(3)->implode(' ')); ?></p>
</article>

<section>
<?php $__currentLoopData = $images->shuffle()->take($max_image); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n =>  $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
    $mobile_img     = cdn_image($image['url']);

    $sentences_p    = $sentences->shuffle()->take(5)->implode(' ');
    $sentences_txt  = word_limiter($sentences_p, 60,'.');
?>

    <aside>
        <img class="img-fluid mx-auto d-block ads-img lazyload" alt="<?php echo e($image['title']); ?>" data-src="<?php echo e($mobile_img); ?>" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="  />
        <br>
        <small>Source: <?php echo e($image['domain']); ?></small>
            <?php if(strpos($ads_link, '//') !== false): ?>
            <center>
                <button class="btn btn-sm btn-success ads-img">Check Details</button>
            </center>
            <?php endif; ?>
        <p align="justify"><?php echo e($sentences_txt); ?></p>
    </aside>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\belajardasar\blade/theme/native1/post.blade.php ENDPATH**/ ?>