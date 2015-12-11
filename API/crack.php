<?php
include("../control.php");
$co = new control();
$search = (isset($_POST['input'])) ? ($co->search($_POST['input'])) : "403";
$mass   = ($search !== false) ? (str_replace(":<!#:#!>:","<br/>Base:",$search)) : $co->fromOther($_POST['input']);
echo $mass;