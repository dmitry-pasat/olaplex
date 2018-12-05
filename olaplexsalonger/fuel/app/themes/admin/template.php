<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    Casset::css('theme::font-awesome.min.css');
    Casset::css('theme::bootstrap.min.css');
    Casset::css('theme::animate.min.css');
    Casset::css('theme::jquery-ui.css');
    Casset::css('theme::rateit.css');
    Casset::css('theme::bootstrap-datetimepicker.min.css');
    Casset::css('theme::jquery.cleditor.css');
    Casset::css('theme::bootstrap-switch.css');
    Casset::css('theme::style.css');
    Casset::css('theme::widgets.css');
    echo Casset::render_css();

    Casset::js('theme::jquery.min.js', true, 'header_core');
    Casset::js('theme::bootstrap.min.js', true, 'header_core');
    Casset::js('theme::jquery-ui-1.9.2.custom.min.js', true, 'header_core');
    Casset::js('theme::jquery.cookie.min.js', true, 'header_core');

    Casset::js('theme::jquery.rateit.min.js', true, 'footer_core');
    Casset::js('theme::jquery.noty.js', true, 'footer_core');
    Casset::js('theme::default.js', true, 'footer_core');
    Casset::js('theme::bottom.js', true, 'footer_core');
    Casset::js('theme::topRight.js', true, 'footer_core');
    Casset::js('theme::top.js', true, 'footer_core');
    Casset::js('theme::sparklines.js', true, 'footer_core');
    Casset::js('theme::jquery.cleditor.min.js', true, 'footer_core');
    Casset::js('theme::bootstrap-datetimepicker.min.js', true, 'footer_core');
    Casset::js('theme::bootstrap-switch.min.js', true, 'footer_core');
    Casset::js('theme::filter.js', true, 'footer_core');
    Casset::js('theme::custom.js', true, 'footer_core');

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
        //auto add post token to form submit
        $(document).ready(function () {
            $("form[method='post']").submit(function () {
                $(this).find('#form_' + ptk).remove();
                $(this).append($('<input type="hidden"/>').attr("id", "form_" + ptk).attr('name', ptk).val($.cookie(ptk)));
            });
        });
    </script>

</head>
<body>
<?php if (!$current_user): ?>
    <?php echo $content; ?>
<?php else: ?>
    <!-- top navigation -->
    <nav role="navigation" class="navbar navbar-fixed-top bs-docs-nav box-shadow">
        <div class="">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <img src="<?php echo Model_Setting::getValueByKey('cp_logo'); ?>" width="auto" height="35px"/>
                </a>
                <button data-target=".bs-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle"><i
                        class="fa fa-align-justify fa-2x "></i></button>
            </div>
            <div class="collapse navbar-collapse bs-navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo $current_user->getGravator(array('width' => '30', 'height' => 'auto', 'class' => 'g-thumbnail')); ?>
                            <?php echo $current_user->first_name; ?> <?php echo $current_user->last_name; ?> <i
                                class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Uri::create('/admin/users/edit/' . $current_user->id); ?>"><i class="fa fa-user"></i>
                                    Profile</a></li>
                            <li><a href="<?php echo Uri::create('admin/settings'); ?>"><i class="fa fa-cogs"></i> Settings</a></li>
                            <li><a href="<?php echo Uri::create('admin/logout'); ?>"><i class="fa fa-sign-out"></i> Sign
                                    Out</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" role="search" action="<?php echo Uri::create('admin/stores'); ?>" method="get">
                    <div class="form-group">
                        <input type="search" name="name" class="form-control" placeholder="Search Stores"
                               value="<?php echo Input::get('name'); ?>">
                    </div>
                </form>

                <ul class="nav navbar-nav visible-xs icon-bar">
                    <li><a href="<?php echo Uri::create('admin/stores'); ?>"><i
                                class="fa fa-map-marker fa-fw fa-3x"></i><br>Stores</a></li>
                    <li><a href="<?php echo Uri::create('admin/users'); ?>"><i class="fa fa-group fa-fw fa-3x"></i><br>Users</a>
                    </li>
                    <li><a href="<?php echo Uri::create('admin/settings'); ?>"><i
                                class="fa fa-cogs fa-fw fa-3x"></i><br>Settings</a></li>
                </ul>


            </div>
        </div>
    </nav>
    <div class="content main-cell" style="">
        <div class="sidebar" style="position: fixed;">
            <ul id="nav" style="">
                <li><a href="<?php echo Uri::create('admin/stores'); ?>"
                       class="<?php if ($navName == "stores") echo "open"; ?>"><i
                            class="fa fa-map-marker fa-fw fa-3x"></i><br>Stores</a></li>
                <li><a href="<?php echo Uri::create('admin/users'); ?>"
                       class="<?php if ($navName == "users") echo "open"; ?>"><i
                            class="fa fa-group fa-fw fa-3x"></i><br>Users</a></li>
                <li><a href="<?php echo Uri::create('admin/content'); ?>?parent_id=93"
                       class="<?php if ($navName == "content") echo "open"; ?>"><i
                            class="fa fa-tags fa-fw fa-3x"></i><br>Categories</a></li>
                <li><a href="<?php echo Uri::create('admin/settings'); ?>"
                       class="<?php if ($navName == "settings") echo "open"; ?>"><i
                            class="fa fa-cogs fa-fw fa-3x"></i><br>Settings</a></li>
            </ul>
        </div>
        <section class="mainbar box-shadow animated fadeIn">
            <div class="page-head animated fadeInUp">
                <h2 class="pull-left"><i class="fa fa-<?php echo $icon; ?> fa-lg"></i> <?php echo $title; ?></h2>

                <div class="bread-crumb pull-right">
                    <a href="index.html"><i class="fa fa-home"></i> Home</a>
                    <?php foreach ($breadcrumbs as $name => $url): ?>
                        <span class="divider">/</span>
                        <?php echo Html::anchor($url, $name, array('class' => '')); ?>
                    <?php endforeach; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="matter">
                <div class="container"><?php echo $content; ?></div>
            </div>
        </section>
    </div>
<?php endif; ?>

<?php echo Casset::render_js('footer_core'); ?>
<?php echo Casset::render_js('footer'); ?>

<?php
$error = Session::get_flash('error');
if ($error):
    ?>
    <script>
        $(document).ready(function () {
            noty({text: '<i class="fa fa-warning"></i> <?php echo $error; ?>', layout: 'top', type: 'warning', timeout: 4000});
        });
    </script>
<?php endif; ?>

<?php
$success = Session::get_flash('success');
if ($success):
    ?>
    <script>
        $(document).ready(function () {
            noty({text: '<i class="fa fa-leaf"></i> <?php echo $success; ?>', layout: 'top', type: 'info', timeout: 4000});
        });
    </script>
<?php endif; ?>


</body>
</html>
