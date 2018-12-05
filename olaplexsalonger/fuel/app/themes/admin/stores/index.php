<div class="row">

    <div class="col-md-3">
        <?php echo Form::open(array('enctype' => 'multipart/form-data', 'id' => 'import-form')); ?>
        <div class="widget animated fadeInUp">
            <div class="widget-head">
                <div class="pull-left"><i class="fa fa-<?php echo $icon; ?>"></i> Import Stores from CSV</div>
                <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a class="wclose" href="#"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-content padd">
                <?php echo Form::file('csv_file', array('required' => 'required')); ?>
            </div>
            <div class="widget-foot">
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload & Import CSV</button>
                    </div>
                    <div class="col-md-6">
                        <a type="button" class="btn btn-primary" href="<?php echo Uri::create('assets/sample.csv'); ?>"><i class="fa fa-download"></i> Sample CSV</a>
                    </div>
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?>
    </div>

    <div class="col-md-9">
        <div class="widget animated fadeInUp">
            <div class="widget-head">
                <div class="pull-left"><i class="fa fa-<?php echo $icon; ?>"></i> <?php echo $title; ?></div>
                <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a class="wclose" href="#"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-content padd">
                You may manage and search store locations below. Click <a href="<?php echo Uri::create('admin/stores/create'); ?>">add store</a> to create a new
                location or <a href="#">import</a> to upload CSV spreadsheet of locations.
            </div>
            <div class="widget-foot">
                <a type="button" class="btn btn-primary" href="<?php echo Uri::create('admin/stores/create'); ?>"><i class="fa fa-plus-square"></i>
                    Add Store</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget animated fadeInUp">
            <div class="widget-head">
                <div class="pull-left"><i class="fa fa-th-list"></i> Store Locations</div>
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
                        <th><a href="#" name="name">Name</a></th>
                        <th class="hidden-xs"><a href="#" name="address">Address</a></th>
                        <th class="visible-lg"><a href="#" name="administrative_area_level_2">City</a></th>
                        <th class="visible-lg"><a href="#" name="administrative_area_level_1">State/Province</a></th>
                        <th class="hidden-sm hidden-xs"><a href="#" name='postal_code'>Postal Code</a></th>
                        <th class="hidden-sm hidden-xs"><a href="#" name='country'>Country</a></th>
                        <th class="visible-lg"><a href="#" name="status">Status</a></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <?php echo Form::open(array('method' => 'get', 'id' => 'sform', 'action' => Uri::create('admin/stores')), array('sort' => $sort, 'order' => $order)); ?>
                        <th class=''><?php echo Form::input('name', Input::get('name'), array('class' => 'form-control')); ?></th>
                        <th class=' hidden-xs'><?php echo Form::input('address', Input::get('address'), array('class' => 'form-control')); ?></th>
                        <th class='visible-lg'><?php echo Form::input('administrative_area_level_2', Input::get('administrative_area_level_2'), array('class' => 'form-control')); ?></th>
                        <th class='visible-lg'><?php echo Form::input('administrative_area_level_1', Input::get('administrative_area_level_1'), array('class' => 'form-control')); ?></th>
                        <th class='hidden-sm hidden-xs'><?php echo Form::input('postal_code', Input::get('postal_code'), array('class' => 'form-control')); ?></th>
                        <th class='hidden-sm hidden-xs'><?php echo Form::input('country', Input::get('country'), array('class' => 'form-control')); ?></th>
                        <th class='visible-lg'></th>
                        <th></th>
                        <?php echo Form::close(); ?>
                    </tr>
                    </thead>
                    <?php if (!$items): ?>
                        <tr>
                            <td colspan="8" class="padd">No locations found.</td>
                        </tr><?php else: ?>
                        <tbody>
                        <?php foreach ($items as $model): ?>
                            <tr>
                                <td><?php echo $model->name; ?></td>
                                <td class="hidden-xs"><?php echo $model->address; ?></td>
                                <td class="visible-lg"><?php echo $model->administrative_area_level_2; ?></td>
                                <td class="visible-lg"><?php echo $model->administrative_area_level_1; ?></td>
                                <td class="hidden-sm hidden-xs"><?php echo $model->postal_code; ?></td>
                                <td class="hidden-sm hidden-xs"><?php echo $model->country; ?></td>
                                <td class="visible-lg">
                                    <?php if ($model->getLatLngStatus()): ?>
                                        <abbr title="Lat/Lng Present"><i class="fa fa-map-marker fa-fw fa-2x"
                                                                         style="color: darkgreen;"></i></abbr>
                                    <?php else: ?>
                                        <abbr title="Lat/Lng NOT Present"><i class="fa fa-map-marker fa-fw fa-2x"
                                                                             style="color: darkred;"></i></abbr>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown"><i class="fa fa-cog"></i></button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="<?php echo Uri::create('admin/stores/edit/' . $model->id); ?>"
                                                   class=""><i class="fa fa-edit"></i> Edit</a></li>
                                            <li>
                                                <a href="<?php echo Uri::create('admin/stores/delete/' . $model->id); ?>"
                                                   class="del-btn"><i class="fa fa-trash-o"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div>
            <div class="widget-foot">
                <div class="row">
                    <div class="col-md-6"><?php echo html_entity_decode($pagination); ?></div>
                    <div class='col-md-6'>
                        <div class="pull-right" style='font-size:120%;margin:0px 10px 0px 0px;'>
                            Found <?php echo number_format($total); ?> results (<?php echo $time; ?> seconds)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    var currentSort = '<?php echo $sort; ?>';
    var currentOrder = '<?php echo $order; ?>';

    $(document).ready(function () {

        $("#import-form").submit(function () {
            $(this).find('button').prop('disabled', true);
            $(this).find('button i').attr('class', 'fa fa-spinner fa-spin');
        });

        $(".data-table input").keypress(function (e) {
            if (e.which == 13) this.form.submit();
        });
        $(".data-table thead a").click(function () {
            var sort = $(this).attr('name');
            var order = currentSort == sort ? (currentOrder == "asc" ? "desc" : "asc") : "asc";
            $('#form_sort').val(sort);
            $('#form_order').val(order);
            $('#sform').submit();
            return false;
        });
        $(".pagination a").click(function () {
            $("#sform").attr('action', $(this).attr('href')).submit();
            return false;
        });
        $(".del-btn").click(function () {
            if (!confirm('Are you sure you want to delete?')) {
                return false;
            }
        })

    });
</script>
