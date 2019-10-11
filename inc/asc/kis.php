<?php
require_once("config.php");
// =================================================
$query = MysqlSelect("SELECT * FROM ms_product_category WHERE parentid='0'");

if(MysqlNumRow($query) > 0) {
    $data = membersTree();
} else {
    $data = ["id"=>"0","name"=>"No Members present in list","nodes"=>[]];
}

function membersTree($id = 0) {
    $query = MysqlSelect("SELECT * FROM ms_product_category WHERE parentid='".MysqlEscape($id)."'");
    $row1 = array();

    while($line = MysqlAssoc($query)) {
        $push = array();
        $push['id'] = $line['productcatid'];
        $push['text'] = $line['name'];
        $push['state']['expanded'] = true; // ALL NODES ARE OPEN

        // =====================================================================
        // while schleife produkte reinschreiben
        // push hinzufügen
        // array in tabelle laden
        /*
        $push['product'] = array();
        $product['product'] = array();
        $productItem = array();
        $products = MysqlSelect("SELECT * FROM ms_product WHERE productcatid='".MysqlEscape($line['productcatid'])."'");
        while($childLine = MysqlAssoc($products)) {
            $productItem['name'] = $childLine['name'];
            $productItem['picture'] = $childLine['picture'];
            array_push($product['product'], $productItem);
        }
        if (MysqlNumRow($products) > 0) {
            array_push($push['product'], $product);
        }
        */
        $products = MysqlSelect("SELECT * FROM ms_product WHERE productcatid = '".MysqlEscape($line['productcatid'])."'");

        if (MysqlNumRow($products) > 0) {

            $push['product'] = array();
            $product = array();

            while($childLine = MysqlAssoc($products)) {

                $product['id'] = $childLine['productid'];
                $product['name'] = $childLine['name'];
                $product['picture'] = $childLine['picture'];
                $product['price'] = $childLine['price'];
                array_push($push['product'], $product);

            }

        }
        // =====================================================================


        $child = MysqlNumRow(MysqlSelect("SELECT * FROM ms_product_category WHERE parentid='".MysqlEscape($line['productcatid'])."'"));
        if($child > 0) {
            $push['nodes'] = membersTree($line['productcatid']);
        }

        array_push($row1, $push);
    }
    return $row1;
}

echo json_encode($data);
?>
