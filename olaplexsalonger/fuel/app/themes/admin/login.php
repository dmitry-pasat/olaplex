<?php echo Form::open(array(), array('')); ?>
<div style="margin-left: auto; margin-right: auto; max-width: 310px; margin-top:5px;">
    <div class="row">
        <div class="col-md-12">
            <div align="center">
                <img src="<?php echo Model_Setting::getValueByKey('cp_logo'); ?>" width="auto" height="50px"/>
            </div>
            <div
                class="widget box-shadow animated <?php if (isset($login_error)): ?>shake<?php else: ?>fadeInUp<?php endif; ?>">
                <div class="widget-head">
                    <i class="fa fa-lock"></i> Locator Sign In
                </div>
                <div class="widget-content padd">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
                        <?php echo Form::input('username', Input::post('username', Common::isDemo() ? 'admin@admin.com' : null), array('type' => 'email', 'required' => 'required', 'placeholder' => 'Email', 'class' => 'form-control', 'autofocus' => 'autofocus')); ?>
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" required="required" value="<?php echo Common::isDemo() ? 'admin' : null; ?>"
                               name="password">
                    </div>
                </div>
                <div class="widget-foot">
                    <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Sign In
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>
<?php if (isset($login_error)): ?>
    <script>
        $(document).ready(function () {
            noty({text: '<i class="fa fa-warning"></i> Oops! Invalid username/password.', layout: 'top', type: 'warning', timeout: 4000});
        });
    </script>
<?php endif; ?>

