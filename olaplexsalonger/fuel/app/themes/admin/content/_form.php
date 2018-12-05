<?php echo Form::open(array('enctype'=>'multipart/form-data'),array('parent_id'=> isset($model) ? $model->parent_id : Input::get('parent_id'))); ?>

<div class='row-fluid'>

    <div class="form-group">
        <label><i class="fa fa-leaf"></i> Title</label>
        <?php echo Form::input('title', Input::post('title', isset($model) ? $model->title : ''), array('class' => 'form-control title-input', 'required' => 'required', 'placeholder' => 'Enter Title')); ?>
    </div>

    <?php if(isset($parent) && $parent->type == "category"): ?>
<!--        <div class="form-group">-->
<!--            <label><i class="fa fa-leaf"></i> Meta Keywords (comma separated)</label>-->
<!--            --><?php //echo Form::textarea('description', Input::post('description', isset($model) ? stripslashes($model->description) : ''), array('class' => 'form-control keyword-input', 'rows' => 8, 'required'=>'required')); ?>
<!--        </div>-->
    <?php elseif(isset($parent) && $parent->type == "image"): ?>
        <div class="form-group">
            <label><i class="icon-picture-2"></i> Screenshot Upload</label>
            <?php echo Form::file('value', array('class' => '')); ?>
            <?php if(isset($model)): ?>
            <div>
                <img src="<?php echo $model->description; ?>" style="width: 50%; height: auto; border: 1px solid #CCC;">
            </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
<!--        <div class="form-group">-->
<!--            <label><i class="fa fa-leaf"></i> Description</label>-->
<!--            --><?php //echo Form::textarea('description', Input::post('description', isset($model) ? stripslashes($model->description) : ''), array('class' => 'form-control', 'rows' => 8)); ?>
<!--        </div>-->
    <?php endif; ?>

    <div class="form-group">
        <label class="icon-preview"><i class="<?php echo (isset($model) && $model->icon ? $model->icon : "fa fa-flask"); ?>"></i> Icon (optional)</label>
        <?php echo Form::input('icon', Input::post('icon', isset($model) ? $model->icon : ''), array('class' => 'form-control icon-input', 'placeholder' => 'Enter Icon Label')); ?>
        <div><a href="#" class="icon-toggle" data-toggle="collapse" data-target="#icon-list"><i class="fa fa-plus-circle"></i> View Available Icons</a></div>
        <div id="icon-list" class="collapse well" style="max-height: 200px; overflow: auto;">
            <?php echo $icons; ?>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-primary" style="margin-top:20px;"><i class="fa fa-save"></i> Save</button>
    </div>

</div>


<?php echo Form::close(); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $(".muted").hide();
        $(".i-name").css('cursor','pointer');
        $("#icons i").css('font-size','200%').css('cursor','pointer');
        $("#icons i").click(function(){
            $x = $(this).parent().clone();
            var className = "fa " + $x.find('i').remove().end().find("span").remove().end().text().trim();
            $("input[name='icon']").val(className);
            $(".icon-preview").find("i").attr("class",className);
            $(".icon-toggle").trigger('click');
        });
    });
</script>