<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    Casset::css('theme::font-awesome.min.css');
    Casset::css('theme::bootstrap.min.css');
    Casset::css('theme::default.css');
    Casset::css('leaflet.css');
    Casset::css('markercluster.css');
    Casset::css('markercluster.default.css');
    echo Casset::render_css();

    Casset::js('theme::jquery.min.js', true, 'header_core');
    Casset::js('theme::jquery.address.min.js', true, 'header_core');
    Casset::js('theme::jquery.cookie.min.js', true, 'header_core');
    Casset::js('theme::bootstrap.min.js', true, 'header_core');
    Casset::js('leaflet.min.js', true, 'header_core');
    Casset::js('leaflet.markercluster-src.js', true, 'header_core');
    echo Casset::render_js('header_core');
    echo Casset::render_js('header');
    ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo Uri::create('assets/css/MarkerCluster.Default.ie.css'); ?>"/><![endif]-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&sensor=false"></script>
    <script type="text/javascript">
        var ptk = '<?php echo Config::get('security.csrf_token_key'); ?>';
        (function () {
            "use strict";
            $.cookie(ptk, '<?php echo Security::fetch_token(); ?>');
        })();
        L.Icon.Default.imagePath = '<?php echo Uri::create('assets/img'); ?>';
    </script>

</head>
<body>
<div class="container" style="margin-top:30px;">
    <div class="row">
       <!-- <div class="col-md-10 col-md-offset-1 main-body 2">-->
        <div class="col-md-12 main-body">
            <?php echo $content; ?>
        </div>
    </div>
</div>
<?php echo Casset::render_js('footer_core'); ?>
<?php echo Casset::render_js('footer'); ?>
</body>
</html>
