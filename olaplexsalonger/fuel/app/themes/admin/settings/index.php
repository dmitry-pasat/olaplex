<div class="row">
    <div class="col-md-12">
        <div class="widget animated fadeInUp">
            <div class="widget-head">
                <div class="pull-left"><i class="fa fa-map-marker"></i> Application Information</div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-content padd">
                <strong>Version 1.3</strong> - <a href="https://storelocatorscript.com">&copy;<?php echo date('Y'); ?> Store Locator Script</a> - All Rights Reserved
            </div>
        </div>
    </div>
</div>


<?php foreach ($settings as $setting): ?>
    <?php if ($setting->group == "HIDDEN") continue; ?>


    <div class="row">
        <div class="col-md-12">
            <div class="widget animated fadeInUp">
                <div class="widget-head">
                    <div class="pull-left"><i class="fa fa-cogs"></i> <?php echo $setting->group; ?></div>
                    <div class="widget-icons pull-right">
                        <a class="wminimize" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a class="wclose" href="#"><i class="fa fa-times"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content">

                    <table class="data-table table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Setting</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach (Model_Setting::query()->where('group', $setting->group)->get() as $item): ?>
                            <tr>
                                <td><?php echo $item->label; ?></td>
                                <td width='10%'>
                                    <a href="<?php echo Uri::create("admin/settings/edit/{$item->id}"); ?>"
                                       class="btn btn-default"><i class='fa fa-edit'></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


