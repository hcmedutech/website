<?php
session_start();
include("../../_system/database/db.php");
$db_account = new DBase("account", "../../_store");
$username = $_REQUEST['username'];

$account_type = $db_account->get("account_type", "username", "$username");
$id_const = $account_type."_id";
$id = $db_account->get("$id_const", "username","$username");
$db = new DBase("$account_type","../../_store");
$first_name = $db->get("first_name", "$id_const", "$id");
$username = $db_account->get("username", "username", "$username");
$photo_url = $db_account->get("photo_url", "username", "$username");

$array = array(
    "first_name"=>"$first_name",
    "username"=>"$username",
    "photo_url"=>"$photo_url"
);
echo json_encode($array);
?>