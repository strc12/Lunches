<?php
print_r($_POST);
session_start();
#$_SESSION["lunchbasket"]=array();
if (!isset($_SESSION["lunchbasket"])){
    $_SESSION["lunchbasket"]=array();#creates basket if not already made
    echo("bob");
}
$found=FALSE;
foreach ($_SESSION["lunchbasket"] as &$item){
    
    if ($item["foodid"]===$_POST["foodid"]){
        $found=TRUE;
        $item["qty"]=$item["qty"]+$_POST["qty"];
        
    }
}
if ($found==FALSE){
    array_push($_SESSION["lunchbasket"],array("foodid"=> $_POST["foodid"], "qty"=>$_POST["qty"]));
}


print_r($_SESSION["lunchbasket"]);
header("location: choosefood.php");
?>