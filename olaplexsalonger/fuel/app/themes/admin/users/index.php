<div class="row">
    <div class="col-md-12">
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
                You may manage and search users below. Click <a href="#">create user</a> to create a new user account.
            </div>
            <div class="widget-foot">
                <a type="button" class="btn btn-primary" href="<?php echo Uri::create('admin/users/create'); ?>"><i
                        class="fa fa-plus-square"></i> Create User</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget animated fadeInUp">
            <div class="widget-head">
                <div class="pull-left"><i class="fa fa-th-list"></i> Users</div>
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
                        <th><a href="#" name="first_name">First</a></th>
                        <th><a href="#" name="last_name">Last</a></th>
                        <th class="hidden-xs"><a href="#" name="email">Email</a></th>
                        <th class="visible-lg"><a href="#" name="last_login">Last Login</a></th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <?php echo Form::open(array('method' => 'get', 'id' => 'sform', 'action' => Uri::create('admin/users')), array('sort' => $sort, 'order' => $order)); ?>
                        <th class=''><?php echo Form::input('first_name', Input::get('first_name'), array('class' => 'form-control')); ?></th>
                        <th class=''><?php echo Form::input('last_name', Input::get('last_name'), array('class' => 'form-control')); ?></th>
                        <th class='hidden-xs'><?php echo Form::input('email', Input::get('email'), array('class' => 'form-control')); ?></th>
                        <th class='visible-lg'><?php echo Form::input('last_login', Input::get('last_login'), array('class' => 'form-control')); ?></th>
                        <th></th>
                        <?php echo Form::close(); ?>
                    </tr>
                    </thead>
                    <?php if (!$items): ?>
                        <tr>
                            <td colspan="8" class="padd">No users found.</td>
                        </tr><?php else: ?>
                        <tbody>
                        <?php foreach ($items as $model): ?>
                            <tr>
                                <td><?php echo $model->first_name; ?></td>
                                <td><?php echo $model->last_name; ?></td>
                                <td class="hidden-xs"><a
                                        href="mailto:<?php echo $model->email; ?>"><?php echo $model->email; ?></a></td>
                                <td class="visible-lg"><?php echo Date::forge($model->last_login)->format('local'); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown"><i class="fa fa-cog"></i></button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="<?php echo Uri::create('admin/users/edit/' . $model->id); ?>"
                                                   class=""><i class="fa fa-edit"></i> Edit</a></li>
                                            <?php if ($model->id > 1): ?>
                                                <li>
                                                    <a href="<?php echo Uri::create('admin/users/delete/' . $model->id); ?>"
                                                       class="del-btn"><i class="fa fa-trash-o"></i> Delete</a></li>
                                            <?php endif; ?>
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
                            Found <?php echo number_format($total); ?> results
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
