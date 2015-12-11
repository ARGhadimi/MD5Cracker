<?php
include("../control.php");
$co = new control();
$commend = $_GET['commend'];
$com     = substr($commend,3);
$re      = array("status" => true);
if(substr($commend,0,3) == "-c/"){
    $search = $co->search($com);
    $mass   = ($search !== false) ? $search : $co->fromOther($com);
    if($mass === "This isn't a MD5 hash."){
        $re['status'] = false;
        $re['code']   = "403";
    }elseif($mass === "Not found"){
        $re['status'] = false;
        $re['code']   = "404";
    }else{
        $a = explode(":<!#:#!>:",$mass);
        if(isset($a[1])){
            $re['base'] = $a[1];
        }
        $re['return']= $a[0];
    }
}elseif(substr($commend,0,3) == "-g/"){
    $a  = $co->newHash($com);
    $re['return']= $a;
    $re['base'] = $com;
}else{
    $re['status'] = false;
    $re['code']   = "405";
}
echo json_encode($re);