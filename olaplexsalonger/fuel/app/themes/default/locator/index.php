<?php if(Common::isDemo()): ?>
    <nav class="navbar navbar-default navbar-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="https://storelocatorscript.com/wp-content/uploads/2014/04/cp_logo-e1397681650941.png"  style="width: 100px; height:auto;">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class=""><a href="<?php echo Uri::create('admin/login'); ?>">Admin Demo</a></li>
                    <li><a href="/#features">Features</a></li>
                    <li><a href="/#pricing">Pricing</a></li>
                    <li><a href="/support/">Support</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
<?php endif; ?>

<div class="hide alert alert-danger failed-server-alert"><strong>Oh snap!</strong> We're currently unable to reach our
    server. Please try again at a later time.
</div>
<div class="hide alert alert-danger general-alert"><strong>Oops!</strong> <span class="message"></span></div>

<div class="panel panel-default loc-panel" style="box-shadow: 0 0 5px rgba(0,0,0,0.02);">
    <!--<div class="panel-heading">
        <h3 class="panel-title">Store Locator2</h3>
    </div>-->
    <div class="panel-body panel-no-padding">
        <div class="row">
            <div class="col-md-4" style="padding:0px;">
                <div style="padding:10px;"><?php echo $_search_form; ?></div>
                <div class="result-set-container" style=""><?php echo $_result_set; ?></div>
            </div>
            <div class="col-md-8" style="padding:0px; background-color:rgba(0,0,0,0.05);">
                <div id="map1" style="height:575px;" class="span12"></div>
            </div>
        </div>
    </div>
</div>

<?php Casset::js('countries.min.js', true, 'footer'); ?>
<?php Casset::js('us-states.min.js', true, 'footer'); ?>
<?php Casset::js('theme::locator.js', false, 'footer'); ?>