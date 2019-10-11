<?php
include("config.php");
// =================================================
$Response = (object) array(
	'error' => false,
	'grund' => 'none',
	'login' => false,
	'logout' => false,
);

// LOGIN
if(!empty($_POST["username"]) && !empty($_POST["password"])) {
	$query = MysqlSelect("SELECT * FROM ms_users WHERE username = '".MysqlEscape($_POST["username"])."'");
	$row = MysqlArray($query);
	
	// GENERATE PASSWORD
	// $hashPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
	// echo $hashPassword;
	
	$verifyPassword = password_verify($_POST["password"], $row["password"]);

	if($row == TRUE && $verifyPassword) {
		
		if($row["locked"] == 0) {
			$Response->login = true;
			$_SESSION["userid"] = $row["userid"];
			MysqlUpdate("UPDATE `ms_users` SET `online` = '".$Server->timestamp."', `lastlogin` = '".date("Y-m-d H:i:s", time())."' WHERE `username` = '".MysqlEscape($_POST["username"])."'");		
		} else {
			$Response->error = true;
			$Response->grund = 'banned';	
		}

	} else {
		$Response->error = true;
		$Response->grund = 'not exsist';
		MysqlUpdate("UPDATE `ms_users` SET `lastlogin` = `lastlogin`, `loginattempts` = `loginattempts` + '1' WHERE `username` = '".MysqlEscape($_POST["username"])."'");
	}
	
} else {
	$Response->error = true;
	$Response->grund = 'empty';
}

// LOGOUT
if($_POST["action"] == "logout" && !empty($_SESSION["userid"])) {
	$Response->logout = true;
	MysqlUpdate("UPDATE `ms_users` SET `online` = '0', `loginattempts` = '0' WHERE `userid` = '".MysqlEscape($_SESSION["userid"])."'");
	session_destroy();
}

echo json_encode($Response);
?>