<?php

define('DOCROOT', '../');
define('APPPATH','../../fuel/app/');

function getcurrentpath()
{   $curPageURL = "";
    if ($_SERVER["HTTPS"] != "on")
        $curPageURL .= "http://";
    else
        $curPageURL .= "https://" ;
    if ($_SERVER["SERVER_PORT"] == "80")
        $curPageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    else
        $curPageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    $count = strlen(basename($curPageURL));
    $path = substr($curPageURL,0, -$count);
    return $path ;
}

$extensions = array(
    'mysqli',
    //'fileinfo',
    'mbstring',
    //'mcrypte',
);


$perms = array(
    APPPATH . 'cache',
    APPPATH . 'logs',
    APPPATH . 'config/development',
    DOCROOT . 'assets/cache',
    DOCROOT . 'installation',
    DOCROOT . 'uploads',
);

//todo, admin password, bing_map_key?, cloudmade_api_key?, map_center (lat,lng,zoom), default_country, max_distance

$errors = array();
if (version_compare(phpversion(), '5.3.3', '<')) {
    $errors[] = "Install and/or enable PHP Version 5.3.3 or newer (PHP 5+ is recommended).";
}

foreach ($extensions as $extension) {
    if (!extension_loaded($extension)) {
        $errors[] = "Install and/or enable {$extension} PHP extension.";
    }
}

$checkPerms = false;
if (!@fopen('del_me.txt', 'wb')) {
    foreach ($perms as $folderPath) {
        if (!is_writable($folderPath)) {
            $errors[] = "Make {$folderPath} writable (change file perms to 777).";
        }
    }
}


$dbConfigStr = "<?php

return array(
    'default'    => array(
        'connection' => array(
            'dsn'      => 'mysql:host={host};dbname={dbname}',
            'username' => '{dbuser}',
            'password' => '{dbpass}',
        ),
    ),

);

";

if (count($errors) == 0 && !empty($_REQUEST['host']) && !empty($_REQUEST['dbname']) && !empty($_REQUEST['dbuser']) && !empty($_REQUEST['dbpass'])) {
    //verify credentials
    $mysqli = new mysqli($_REQUEST['host'], $_REQUEST['dbuser'], $_REQUEST['dbpass'], $_REQUEST['dbname']);

    /* check connection */
    if (mysqli_connect_errno()) {
        $mError = "Connect failed: " . mysqli_connect_error();
    } else {
        //continue with installation
        if (($sql = file_get_contents(APPPATH . 'sql/psl_distro.sql')) === false) {
            $mError = "Cannot read SQL file for installation: " . APPPATH . 'sql/psl_distro.sql';
        } else {
            //write db.php config file
            $dbConfigStr = str_replace('{host}', $_REQUEST['host'], $dbConfigStr);
            $dbConfigStr = str_replace('{dbname}', $_REQUEST['dbname'], $dbConfigStr);
            $dbConfigStr = str_replace('{dbuser}', $_REQUEST['dbuser'], $dbConfigStr);
            $dbConfigStr = str_replace('{dbpass}', $_REQUEST['dbpass'], $dbConfigStr);

            if (file_put_contents(APPPATH . 'config/development/db.php', $dbConfigStr) === false) {
                $mError = "Could not write db.php config file: " . APPPATH . 'config/production/db.php';
            } else {
                $logoUrl = getcurrentpath() . "../assets/img/cp_logo.png";
                $sql .= "\n\nUPDATE `settings` set `value` ='{$logoUrl}' where `key` = 'cp_logo';";
                $mysqli->multi_query($sql);
                $mysqli->close();
                array_map('unlink', glob(APPPATH . 'installation'));

                header('Location: ../');
                die('Installation Finished');
            }
        }
    }

}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Installation Wizard -- PHP Store Locator Script</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" align="center">
            <img src="logo.png" width="225px" height="auto" style="margin-bottom: 20px;">
        </div>
    </div>

    <div class="row">

        <?php if (count($errors)): ?>
            <div class="col-md-12">
                <div class="panel panel-default panel-danger">
                    <div class="panel-heading">
                        <div class="panel-title">Oops! Server Requirements Missing</div>
                    </div>
                    <div class="panel-body " style="overflow:auto;">
                        <p>Please contact your host provider and request the following items to be completed:</p>
                        <h5>Missing Requirements:</h5>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="form-group" style="margin-top: 25px;">
                            <button class="btn btn-danger" type="submit">Refresh & Try Again</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <form method="get">
                <div class="col-md-4 col-md-offset-4">

                    <div class="panel panel-default panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Control Panel Information</div>
                        </div>
                        <div class="panel-body">

                            <p>The default administration panel login credentials are below. You may change the default
                                login credentials in the control panel (after installation).</p>

                            <div><strong>Login:</strong> http://yourdomain.com/installpath/admin/</div>
                            <div><strong>Username:</strong> admin@admin.com</div>
                            <div><strong>Password:</strong> admin</div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">Installation Wizard</div>
                        </div>
                        <div class="panel-body">
                            <?php if (isset($mError)): ?>
                                <div class="alert alert-danger">
                                    <?php echo $mError; ?>
                                </div>
                            <?php endif; ?>
                            <!-- mysql -->
                            <div class="form-group">
                                <label>MySQL Credentials</label>
                                <input type="input" name="host" value="<?php echo $_REQUEST['host']; ?>"
                                       required="required"
                                       class="form-control" placeholder="Enter MySQL Host"/>
                            </div>
                            <div class="form-group">
                                <input type="input" name="dbname" value="<?php echo $_REQUEST['dbname']; ?>"
                                       required="required" class="form-control" placeholder="Enter MySQL Database"/>
                            </div>
                            <div class="form-group">
                                <input type="input" name="dbuser" value="<?php echo $_REQUEST['dbuser']; ?>"
                                       required="required" class="form-control" placeholder="Enter MySQL Username"/>
                            </div>
                            <div class="form-group">
                                <input type="input" name="dbpass" value="<?php echo $_REQUEST['dbpass']; ?>"
                                       required="required" class="form-control" placeholder="Enter MySQL Password"/>
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" value="1" required="required">
                                    I agree to <a href="/assets/license.htm" target="_blank">license
                                        agreement</a>.</label>
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Finish Installation</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>