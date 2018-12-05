<div class="row">
    <div class="col-md-4">
        <div class="widget animated fadeInUp">
            <div class="widget-head">
                <div class="pull-left"><i class="fa fa-edit"></i>
                    <?php if ($user->id == $current_user->id): ?>
                        Edit My Profile
                    <?php else: ?>
                        Edit User Account
                    <?php endif; ?>
                </div>
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



