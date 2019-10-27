<?php
include("config.php");
include("functions.php");
// =================================================
$Response = (object) array(
	'error' => false,
	'grund' => 'none',
	'revert' => false,
);

// RETURN
if($_POST["state"] != "" && !empty($_POST["firstname"]) && !empty($_POST["surname"])
	&& !empty($_POST["bonnr"])	&& !empty($_POST["bondate"])
	&& !empty($_POST["product"]) && !empty($_POST["comment"])) {

    // Status
    if($_POST["state"] != "Offen" && $_POST["state"] != "Ausgetauscht") {
        $Response->error = true;
        $Response->grund = 'wrong status format';
    }

    // Names
    if(strlen($_POST["firstname"]) > 32 || strlen($_POST["surname"]) > 32) {
        $Response->error = true;
        $Response->grund = 'long names';
    }

    // Email & Phone
	if($_POST["noemail"] == false && $_POST["nophone"] == false) {

			if(!empty($_POST["email"]) && !empty($_POST["telefon"])) {
                if(!emailValidation($_POST["email"]) || !phoneValidation($_POST["telefon"])) {
                    $Response->error = true;
    				$Response->grund = 'wrong emtel format';
                }
			} else {
				$Response->error = true;
				$Response->grund = 'empty emtel';
			}

	} else {
		if($_POST["noemail"] == false && $_POST["nophone"] == true) {

            $_POST["telefon"] = "-";

			if(!empty($_POST["email"])) {
                if(!emailValidation($_POST["email"])) {
                    $Response->error = true;
					$Response->grund = 'wrong email format';
                }
			} else {
				$Response->error = true;
				$Response->grund = 'empty email';
			}
		}

		if($_POST["noemail"] == true && $_POST["nophone"] == false) {

            $_POST["email"] = "-";

            if(!empty($_POST["telefon"])) {
                if(!phoneValidation($_POST["telefon"])) {
                    $Response->error = true;
                    $Response->grund = 'wrong telefon format';
                }
            } else {
                $Response->error = true;
                $Response->grund = 'empty telefon';
            }
		}

        if($_POST["noemail"] == true && $_POST["nophone"] == true) {
            $_POST["telefon"] = "-";
            $_POST["email"] = "-";
        }
	}

    // Bon Number
    if(!bonValidation($_POST["bonnr"])) {
        $Response->error = true;
        $Response->grund = 'wrong bonnr format';
    }

    // Bon Date
    if(!bonDateValidation($_POST["bondate"])) {
        $Response->error = true;
        $Response->grund = 'wrong bondate format';
    }

    // Product / Comment
    if(strlen($_POST["product"]) > 255 || strlen($_POST["comment"]) > 255) {
        $Response->error = true;
        $Response->grund = 'long strings';
    }

    if($Response->error == false) {
        $Response->revert = true;
        // DEBUG: INSERT MYSQL
        MysqlInsert("INSERT INTO `ms_returns` (returnid, storeid, userid, firstname, lastname,
            telefon, email, product, comment, bonnumber, bondate, dateofreturn, status)
        VALUES (NULL,
            '".MysqlEscape(getUserData("storeid"))."', '".MysqlEscape(getUserData("userid"))."',
            '".MysqlEscape($_POST["firstname"])."', '".MysqlEscape($_POST["surname"])."',
            '".MysqlEscape($_POST["telefon"])."', '".MysqlEscape($_POST["email"])."',
            '".MysqlEscape($_POST["product"])."', '".MysqlEscape($_POST["comment"])."',
            '".MysqlEscape($_POST["bonnr"])."', '".MysqlEscape(date("Y-m-d", strtotime($_POST["bondate"])))."',
            NOW(), '".MysqlEscape($_POST["state"])."')");
    }

} else {
	$Response->error = true;
	$Response->grund = 'empty';
}

	echo json_encode($Response);
// =================================================
?>
