<?php
if(!file_exists("config.php")){
    header("location: ./install.php");
}elseif (file_exists("install.php")) {
    $code = <<<'HTML'
<html>
    <head>
        <title>Script Was Installed</title>
    </head>
    <body>
        <h3>Script Was Installed!</h3>
    </body>
<html>
HTML;

    file_put_contents("install.php", "<>");
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>MD5 Cracker</title>
    <meta name="author" content="AliReza Ghadimi"/>
    <meta name="description" content="The best MD5 hash cracker with simple API and user access"/>
    <meta name="keyboard" content="MD5,Crack,Cracker,Hash,کرک,کرکر,Hack"/>
    <link rel="stylesheet" href="css/foundation.css"/>
    <script src="js/vendor/modernizr.js"></script>
    <link rel="stylesheet" href="foundation-icons.css" />
</head>
<body>
<div class="row">
    <div class="large-12 columns">
        <h1>MD5 Cracker</h1>
    </div>
</div>

<div class="row">
    <div class="large-12 columns">
        <div class="panel">
            <div class="content" id="panel2-2" aria-hidden="true" tabindex="-1">
                <div class="row collapse">

                    <div class="small-3 columns">
                        <button id="generate_btn" type='submit' class="postfix button success">Generate</button>
                    </div>

                    <div class="small-6 columns">
                        <input id="input" name='generate' type="text" placeholder="Enter your word here...">
                    </div>
                    <div class="small-3 columns">
                        <button id="crack_btn" type='submit' class="postfix button success">Crack</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="large-12 columns">
        <div class="panel">
            <div id="return" class="row collapse">
                <p>
                <h3>Over <b style='font-size: 30px;'>5,000,000,000</b> MD5 hash in our database.</h3>
                </p>
            </div>
        </div>
    </div>

    <div class="large-12 columns">
        Make with <i class="step fi-heart size-72"></i> By <a title="AliReza Ghadimi" target="_blank" href="http://ARGhadimi.GitHub.io">AliReza Ghadimi</a>
    </div>

</div>

<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
    $("#generate_btn").click(function () {
        $.post("API/generate.php",
            {
                input: ($("#input").val())
            },
            function (data, status) {
                document.getElementById("return").innerHTML = data;
            });
    });
    $("#crack_btn").click(function () {
        $.post("API/crack.php",
            {
                input: ($("#input").val())
            },
            function (data, status) {
                document.getElementById("return").innerHTML = data;
            });
    });
</script>
</body>
</html>