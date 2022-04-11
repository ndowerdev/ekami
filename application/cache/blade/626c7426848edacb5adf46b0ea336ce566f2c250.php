<?php

$random_related = $random_related ?? '';

if (!$random_related) {
    $random_related = random_related($niche, 10, 'keyword, slug');
}

$related = collect($random_related);

$query = $query ?? '';
$nc = $query ? "Search {$query} from {$niche}" : $niche;
$site_title = blade_sitename($nc);
$site_desc = blade_sitedesc($nc);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8' />
    <meta content='width=device-width,minimum-scale=1,initial-scale=1' name='viewport' />
    <meta name="theme-color" content="#ffffff" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <title>
        <?php $__env->startSection('title'); ?>
            <?php echo e($site_title); ?>

        <?php echo $__env->yieldSection(); ?>
    </title>
    <?php if ($__env->exists('theme.native1.css')) echo $__env->make('theme.native1.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css"
        integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php echo $__env->yieldContent('head'); ?>
    <?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top py-3">
        <a class="navbar-brand" href="/">
            <?php echo e($site_title); ?>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <?php $__currentLoopData = pages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo e(imake_url('p', $page)); ?>"><?php echo e(imake_stringcase('ucwords', str_replace('-', ' ', $page))); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <form id="search-box" class="form-inline my-2 my-lg-0">
                <div class="input-group">
                    <?php if(!IS_CLI): ?>
                        <div class="input-group-prepend">
                            <select class="custom-select" id="search_niche">
                                <?php $__currentLoopData = niche_arr(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat); ?>"><?php echo e(ucwords(str_replace('-', ' ', $cat))); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <input id="search_query" type="text" class="form-control" aria-label="Search input"
                        placeholder="Search here..">
                </div>
            </form>
        </div>
    </nav>

    <main role="main" class="container top_main">

        <header>
            <center>
                <h1>
                    <?php $__env->startSection('title'); ?>
                        <?php echo e($site_title); ?>

                    <?php echo $__env->yieldSection(); ?>
                </h1>
                <p class="lead">
                    <?php $__env->startSection('description'); ?>
                        <?php echo e($site_desc); ?>

                    <?php echo $__env->yieldSection(); ?>
                </p>
            </center>
        </header>

        <div class="row">
            <div class="col-md-8 p-md-2 border">
                <?php echo $__env->yieldContent('content'); ?>
                <center>
                    <?php echo $__env->make('ads_btn_banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </center>
            </div>
            <div class="col-md-4 p-2">
                <h3>More <?php echo e($query); ?> articles : </h3>
                <ul class="list-group">
                    <?php $__currentLoopData = $related->shuffle()->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $slug = $info['slug'];
                            $kw = $info['keyword'];
                            $link = imake_url($niche, $slug);
                            $kw_html = htmlspecialchars($kw);
                            $img_url = blade_image($kw, true, '&w=50&h=50&c=7');
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center mb-1">
                            <a href="<?php echo e($link); ?>">
                                <?php echo e(ucwords($kw)); ?>

                            </a>
                            <div class="image-parent">
                                <a href="<?php echo e($link); ?>">
                                    <img src="<?php echo e($img_url); ?>" class="img-fluid" alt="<?php echo e($kw_html); ?>">
                                </a>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>

    </main><!-- /.container -->
    <footer class="container border-top mt-4 py-4">
        <center><?php echo e(date('Y')); ?> <?php echo e($site_title); ?>. All rights reserved </center>
    </footer>
    <?php if(IS_UADS === false): ?>
        <div class="popbox hide" id="popbox">
            <div aria-label='Close' class="pop-overlay" role="button" tabindex="0"></div>
            <div class="pop-content">
                <div class="popcontent" align="center">
                    <img data-src="https://1.bp.blogspot.com/-y8AsxfEerDc/YFSyMPZF14I/AAAAAAAAAAM/JUegMgSE-3o5A_06mx0Fir2-dkB6fAGvACLcBGAsYHQ/s640/re.jpg"
                        src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" width="640"
                        height="320" class="lazyload" alt="" />
                    <button class='g_url btn btn-success btn-dwn m-2'>Confirm</button>
                    <br />
                </div>
                <button class='g_url popbox-close-button'>&times;</button>
            </div>
        </div>
    <?php endif; ?>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js"
        integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.bundle.min.js"
        integrity="sha512-mULnawDVcCnsk9a4aG1QLZZ6rcce/jSzEGqUkeOLy0b6q0+T6syHrxlsAGH7ZVoqC93Pd0lBqd6WguPWih7VHA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.0/lazysizes.min.js"
        integrity="sha512-JrL1wXR0TeToerkl6TPDUa9132S3PB1UeNpZRHmCe6TxS43PFJUcEYUhjJb/i63rSd+uRvpzlcGOtvC/rDQcDg=="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        var current = window.location.href;
        var origin = window.location.origin;
        var g_confirm = current.includes('c=1');
        var go_ads = '<?php echo e(ADS_LINK); ?>';
        var is_cli = '<?php echo e(IS_CLI); ?>';
        var is_uads = '<?php echo e(IS_UADS); ?>';

        $(document).ready(function() {
            if (go_ads.includes('//')) {
                if (!g_confirm && !is_uads) {
                    $(window).scroll(function(event) {
                        var scroll = $(window).scrollTop();
                        if (scroll >= 200) {
                            $('#popbox').removeClass('hide');
                        }
                        console.log('scroll..');
                    });
                }

                $(document).on('click', '.g_url', function(e) {
                    e.preventDefault();

                    var g_target = current.includes("?") ? current + "&c=1" : current + "?c=1";

                    window.open(go_ads, "_blank");
                    window.location.href = g_target;
                });

                $(document).on('click', '.ads-img', function(e) {
                    e.preventDefault();
                    window.open(go_ads, '_blank');
                });
            }

            $("[id*='google-cache']").remove();

            $(document).on('submit', '#search-box', function(e) {
                e.preventDefault();

                var query = $('#search_query').val();
                query = query.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '').replace(/\s\s+/g,
                ' ');

            if (is_cli) {
                var target = 'site:' + location.host + ' ' + query;
                var uri = 'https://www.google.com/search?q=' + encodeURIComponent(target);
            } else {
                var niche = $('#search_niche').val();
                var uri =
                    `${origin}/search?n=${encodeURIComponent(niche)}&q=${encodeURIComponent(query)}`;
                }
                window.open(uri, '_self');
            });
        });
    </script>
</body>

</html>
<?php /**PATH D:\laragon\www\belajardasar\blade/theme/native1/layout.blade.php ENDPATH**/ ?>