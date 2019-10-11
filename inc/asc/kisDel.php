<?php
include("config.php");
include("functions.php");
// =================================================
if(checkLogin()) {
if($_POST['aktion'] == 'DelNode') {
    $query = MysqlSelect("SELECT * FROM ms_product_category WHERE productcatid='".MysqlEscape($_POST['ID'])."'");
    $row = MysqlArray($query);

    if($row == TRUE) {

        function delNode($id) {
            $query2 = MysqlSelect("SELECT * FROM ms_product_category WHERE parentid='".MysqlEscape($id)."'");
            while($row2 = MysqlAssoc($query2)) {
                delNode($row2['productcatid']);
                MysqlDelete("DELETE FROM ms_product_category WHERE productcatid='".MysqlEscape($row2['productcatid'])."'");
            }
            return;
        }

        delNode($row['productcatid']); // Function before mysqldelete...
        MysqlDelete("DELETE FROM ms_product_category WHERE productcatid='".MysqlEscape($row['productcatid'])."'");
    }
}
}
?>
