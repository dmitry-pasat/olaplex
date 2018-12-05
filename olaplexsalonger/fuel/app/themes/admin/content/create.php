<div class="row">
    <div class="col-md-8">
        <div class="widget animated fadeInUp">
            <div class="widget-head">
                <div class="pull-left"><i class="fa fa-<?php echo $icon; ?>"></i> Create <?php echo ($parent ? $parent->title : "Content"); ?></div>
                <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a class="wclose" href="#"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-content padd">
                <?php echo $_form; ?>
            </div>
        </div>
    </div>
</div>
