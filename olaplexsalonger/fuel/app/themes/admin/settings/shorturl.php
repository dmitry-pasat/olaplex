<div class="row">
    <div class="col-md-6">
        <div class="widget animated fadeInUp">
            <div class="widget-head">
                <div class="pull-left"><i class="fa fa-shield"></i> Generate a Escrow Purchase Link</div>
                <div class="widget-icons pull-right">
                    <a class="wminimize" href="#"><i class="fa fa-chevron-up"></i></a>
                    <a class="wclose" href="#"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="widget-content padd">
                <form id="link-form" autocomplete="off">
                    <div class="form-group">
                        <label><i class="icon-globe"></i> Enter Domain</label>
                        <input type='text' name='domain' class='form-control' placeholder='E.g. mydomain.com'
                               required="required" value="<?php echo Input::get('domain'); ?>">
                    </div>
                    <div class="form-group">
                        <label><i class="icon-cart"></i> Enter Purchase Price</label>
                        <input type='number' name='price' class='form-control' required="required"
                               placeholder="E.g. 10000" value="<?php echo Input::get('price'); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="icon-magic"></i> Create 30 Day Purchase Link
                    </button>
                </form>

                <div class="form-group alert alert-info gbox" style="margin-top: 20px; display: none;">
                    <label><i class="icon-link"></i> Purchase Link Directions: Copy & Paste link below into email for
                        client to purchase.</label>
                    <input type="text" class="form-control genurl" name="genurl"/>
                </div>
            </div>

        </div>
    </div>
</div>


<script>

    $(function () {
        var baseUrl = '<?php echo Uri::create('admin/settings/genshorturl'); ?>';
        $('#link-form').submit(function (evt) {
            $.getJSON(baseUrl, $(this).serializeArray(), function (data) {
                $("input[name='genurl']").val(data.shorturl);
                $(".gbox").fadeIn();
            });
            return false;
        });
    });
</script>