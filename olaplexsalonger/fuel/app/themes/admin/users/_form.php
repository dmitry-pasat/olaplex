<?php echo Form::open(); ?>

<div class='row-fluid'>

    <div class="form-group">
        <label><i class="fa fa-user"></i> First & Last Name</label>

        <div class="row">
            <div class="col-md-6">
                <?php echo Form::input('first_name', Input::post('first_name', isset($user) ? $user->first_name : ''), array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'First Name')); ?>
            </div>
            <div class="col-md-6">
                <?php echo Form::input('last_name', Input::post('last_name', isset($user) ? $user->last_name : ''), array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Last Name')); ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label><i class="fa fa-envelope"></i> Email</label>
        <?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'form-control', 'required' => 'email')); ?>
    </div>


    <?php if (isset($user)): ?>

        <div class="form-group">
            <label><i class="fa fa-lock"></i> Password Reset (optional)</label>
        </div>

        <div class="form-group">
            <label>Current Password</label>
            <?php echo Form::password('old_password', '', array('class' => 'form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label(isset($user) ? "New Password" : "Password", 'password'); ?>
            <?php echo Form::password('password', '', array('class' => 'form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label(isset($user) ? "Confirm New Password" : "Password", 'password'); ?>
            <?php echo Form::password('confirm_password', '', array('class' => 'form-control')); ?>
        </div>
    <?php else: ?>
        <div class="form-group">
            <?php echo Form::label("Password*", 'password'); ?>
            <?php echo Form::password('password', '', array('class' => 'form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label("Confirm Password*", 'password'); ?>
            <?php echo Form::password('confirm_password', '', array('class' => 'form-control')); ?>
        </div>
    <?php endif; ?>

    <div>
        <button type="submit" class="btn btn-primary" style="margin-top:20px;"><i class="fa fa-save"></i> Save</button>
    </div>

</div>


<?php echo Form::close(); ?>

