<?php if(isset($parent) && $parent->key != 'catindex'): ?>
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
                You may manage and create content below. Click <a href="#">create</a> to create new content.
            </div>
            <div class="widget-foot">
                <a type="button" class="btn btn-primary"
                   href="<?php echo Uri::create('admin/content/create?parent_id=' . (isset($parent) ? $parent->id : "")); ?>"><i
                        class="fa fa-plus-square"></i> Create</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="widget animated fadeInUp">
            <div class="widget-head">
                <div class="pull-left"><i
                        class="fa fa-<?php echo(isset($parent) ? $parent->icon : "cogs"); ?>"></i> <?php echo(isset($parent) ? $parent->title : "Page Content"); ?>
                </div>
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
                        <th>&nbsp;</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pages as $page): ?>
                        <tr>
                            <td>
                                <?php if ($page->locked): ?>
                                    <a href="<?php echo Uri::create('admin/content'); ?>?parent_id=<?php echo $page->id; ?>"><i class="fa fa-leaf"></i> <?php echo $page->title; ?></a>
                                <?php else: ?>
                                    <i class="<?php echo $page->icon; ?>"></i> <?php echo $page->title; ?>
                                <?php endif; ?>
                            </td>
                            <td width='10%'>
                                <?php if(!$page->locked): ?>
                                    <a href="<?php echo Uri::create("admin/content/edit/{$page->id}"); ?>" class="btn btn-default"><i class='fa fa-edit'></i></a>
                                    <a href="<?php echo Uri::create("admin/content/delete/{$page->id}"); ?>" class="btn btn-default del-btn"><i class='fa fa-trash-o'></i></a>
                                <?php else: ?>
                                    <a href="<?php echo Uri::create('admin/content'); ?>?parent_id=<?php echo $page->id; ?>" class="btn btn-default"><i class="fa fa-list"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".del-btn").click(function(){
            return(confirm('Are you sure you want to delete?'));
        });
    });
</script>
