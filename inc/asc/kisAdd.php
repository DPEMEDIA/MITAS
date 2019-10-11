<?php
require_once("config.php");
require_once("functions.php");
// =================================================
if(checkLogin()) {

if($_POST['aktion'] == 'AddNode') {
    $addCategory = MysqlInsert("INSERT INTO ms_product_category (productcatid, name, parentid) VALUES (NULL, '".MysqlEscape($_POST['Name'])."', '".MysqlEscape($_POST['ID'])."')");
    require_once("kis.php");
}

// Add product
if($_POST['aktion'] == 'AddProduct') {
    $addCategory = MysqlInsert("INSERT INTO ms_product (productid, productcatid, name) VALUES (NULL, '".MysqlEscape($_POST['ID'])."', '".MysqlEscape($_POST['Name'])."')");
    require_once("kis.php");
}

}
?>
