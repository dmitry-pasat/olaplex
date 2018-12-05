<div class="row">
    <div class="col-md-6">
        <div class="widget animated fadeInUp">
            <div class="widget-head">
                <div class="pull-left"><i class="fa fa-cog"></i> <?php echo $setting->label; ?></div>
                <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a class="wclose" href="#"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-content padd">

                <?php echo Form::open(); ?>
                <div>
                    <?php echo Form::textarea('value', Input::post('value', isset($setting) ? $setting->value : ''), array('class' => 'form-control fill-up', 'rows' => 8, 'required' => 'required')); ?>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top:20px;">Save</button>

                <?php echo Form::close(); ?>


            </div>
        </div>
    </div>
</div>
