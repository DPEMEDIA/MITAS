<?php
require_once("config.php");
require_once("functions.php");
// =================================================
$getReturns = MysqlSelect("SELECT * FROM `ms_returns`");

while($line = MysqlAssoc($getReturns)) {
    $data[] = $line;
}

$results = ["sEcho" => 1,

        	"iTotalRecords" => count($data),

        	"iTotalDisplayRecords" => count($data),

        	"aaData" => $data ];

echo json_encode($results);
?>
