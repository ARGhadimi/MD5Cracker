<?php
if(file_exists("config.php")){
    header("location: ./");
}
$i = (isset($_POST['do'])) ? $_POST['do'] : "No";
if ($i == "yes") {
    $config = "<?php
define(\"db_host\",\"" . $_POST['host'] . "\");
define(\"db_user\",\"" . $_POST['username'] . "\");
define(\"db_pass\",\"" . $_POST['password'] . "\");
define(\"db_name\",\"" . $_POST['name'] . "\");";
    $myfile = fopen("config.php", "w") or die("Unable to open config file!");
    fwrite($myfile, $config);
    fclose($myfile);
    include "control.php";
    (new control("config.php"))->install();
    header("location: ./");
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Cracker | Home</title>
    <link rel="stylesheet" href="css/foundation.css"/>
    <script src="js/vendor/modernizr.js"></script>
</head>
<body>
<div class="row">
    <div class="large-12 columns">
        <h1>MD5 Cracker install</h1>
    </div>
</div>

<div class="row">
    <div class="large-12 columns">
        <div class="panel">
            <div class="content" id="panel2-2" aria-hidden="true" tabindex="-1">
                <form method="post">
                    <input type="hidden" name="do" value="yes">

                    <div class="row collapse">
                        <div class="small-6 columns">
                            <label for="host">Database host(Sometime is localhost):</label>
                            <input id="host" name='host' type="text" placeholder="localhost">
                        </div>
                        <div class="small-6 columns">
                            <label for="username">Database username:</label>
                            <input id="username" name='username' type="text" placeholder="root">
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="small-6 columns">
                            <label for="password">Database password:</label>
                            <input id="password" name='password' type="password" placeholder="password">
                        </div>
                        <div class="small-6 columns">
                            <label for="name">Database name:</label>
                            <input id="name" name='name' type="text" placeholder="cracker">
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="small-6 columns">
                            <input class="postfix button warning" id="submit" type="submit" value="Submit">
                        </div>
                        <div class="small-6 columns">
                            <input class="postfix button warning" id="reset" type="reset" value="Reset">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>