<?php
include("../control.php");
$co = new control();
$a  = (isset($_POST['input'])) ? ($co->newHash($_POST['input'])) : "403";
echo $a;