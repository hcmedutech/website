<?php
/*
Checks if user has enabled e-cash
Returns String yes or no
*/
session_start();
include("../../_system/database/db.php");
$db_ecash = new DBase("ecash", "../../_store");

if(empty($_REQUEST['user_id'])){
    echo "no";
} else {
    $user_id = $_REQUEST['user_id'];
    $allow_ecash = $db_ecash->get("allow_ecash","user_id", "$user_id");
    echo $allow_ecash;
}
?>