<?php
// ==========================================================================
// Check Login
// ==========================================================================
function checkLogin() {

	global $Server;

	$checkBan = MysqlArray(MysqlSelect("SELECT * FROM `ms_users` WHERE `userid` = '".MysqlEscape($_SESSION[$Server->session])."'"));

	if($_SESSION[$Server->session] && $checkBan["locked"] != "1") {
		return TRUE;
	} else {
		return FALSE;
	}
}

// ==========================================================================
// Check Role
// ==========================================================================
// 1 = Administrator
// 2 = Filialleiter
// 3 = Mitarbeiter
// ==========================================================================
function checkAdmin() {

	global $Server;

	if($_SESSION[$Server->session]) {

		$checkAdmin = MysqlArray(MysqlSelect("SELECT * FROM `ms_users` WHERE `userid` = '".MysqlEscape($_SESSION[$Server->session])."'"));

		if($checkAdmin["roleid"] == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

// ==========================================================================
// Get UserData
// ==========================================================================
function getUserData($getData)
{
	global $Server;

	if(checkLogin()) {
		$getUserQuery = MysqlArray(MysqlSelect("SELECT * FROM `ms_users` WHERE `userid` = '".MysqlEscape($_SESSION[$Server->session])."'"));
		$getData = $getUserQuery[$getData];
		return $getData;
	}
}

// ==========================================================================
// Get StoreData
// ==========================================================================
function getStoreData($getData)
{
	global $Server;

	if(checkLogin()) {
		$getUserData = getUserData("storeid");
		$getStoreQuery = MysqlArray(MysqlSelect("SELECT * FROM `ms_stores` WHERE `storeid` = '".MysqlEscape($getUserData)."'"));
		$getData = $getStoreQuery[$getData];
		return $getData;
	}
}

// ==========================================================================
// Check Auto-Logout
// ==========================================================================
function checkLogout()
{
	global $Server;

	$checkLogout = MysqlSelect("SELECT * FROM `ms_users` WHERE `userid` = '".MysqlEscape($_SESSION[$Server->session])."'");
	while($getLogout = MysqlAssoc($checkLogout)) {

		$online = $Server->timestamp - $getLogout["online"];

		// Check If it's not logged about 15 Minutes

		if($online > 900) {
			if(!checkAdmin()) {
				if($getLogout["userid"] != 0) {
					session_destroy();
					echo '<div class="col-md-12 mt-4">';
					echo '<div class="card">';
					echo '<div class="card-header bg-danger">';
					echo '<i class="fas fa-exclamation-triangle"></i> Automatische Abmeldung';
					echo '<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Eine automatische Abmeldung hat stattgefunden."></i></span>';
					echo '</div>';
					echo '<div class="card-body">';
					echo 'Du wurdest wegen Inaktivität abgemeldet.';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					MysqlUpdate("UPDATE `ms_users` SET `online` = '0' WHERE `userid` = '".MysqlEscape($_SESSION[$Server->session])."'");
				}
			} else {
				MysqlUpdate("UPDATE `ms_users` SET `online` = '".$Server->timestamp."' WHERE `userid` = '".MysqlEscape($_SESSION[$Server->session])."'");
			}
		} else {
			MysqlUpdate("UPDATE `ms_users` SET `online` = '".$Server->timestamp."' WHERE `userid` = '".MysqlEscape($_SESSION[$Server->session])."'");
		}
	}
}

// ==========================================================================
// We Vape together
// ==========================================================================
function welcome()
{
	global $Server;

	$getUser = MysqlArray(MysqlSelect("SELECT * FROM `ms_users` WHERE `userid` = '".MysqlEscape($_SESSION[$Server->session])."'"));

    $timestamp = $Server->timestamp;
    $dateOfVar = date("d.m.Y", $timestamp);
    $timeOfVar = date("H:i", $timestamp);
    $phpClock = " ";

    if($timeOfVar > "00:00" && $phpClock < "03:00" || $phpClock == "00:00") {
		if(!checkAdmin()) {
			$welcome = "Guten Abend, ".$getUser["firstname"];
		} else {
			$welcome = "Guten Abend, Admin";
		}
    }

    if ($timeOfVar > "03:00" && $phpClock < "12:00" || $phpClock == "03:00") {
		if(!checkAdmin()) {
			$welcome = "Guten Morgen, ".$getUser["firstname"];
		} else {
			$welcome = "Guten Morgen, Admin";
		}
    }

    if ($timeOfVar > "12:00" && $phpClock < "18:00" || $phpClock == "12:00") {
		if(!checkAdmin()) {
			$welcome = "Guten Tag, ".$getUser["firstname"];
		} else {
			$welcome = "Guten Tag, Admin";
		}
    }

    if ($timeOfVar > "18:00" && $phpClock < "00:00" || $phpClock == "18:00") {
		if(!checkAdmin()) {
			$welcome = "Guten Abend, ".$getUser["firstname"];
		} else {
			$welcome = "Guten Abend, Admin";
		}
    }

    if ($dateOfVar == "24.12.") {
		if(!checkAdmin()) {
			$welcome = "Frohes Weihnachtsfest wünscht dir die Geschäftsleitung!";
		} else {
			$welcome = "Merry Christmas, Admin";
		}
    }

    if ($dateOfVar == "31.12.") {
		if(!checkAdmin()) {
			$welcome = "Guten Rutsch ins neue Jahr wünscht dir die Geschäftsleitung!";
		} else {
			$welcome = "Happy New Year, Admin";
		}
    }

    if ($dateOfVar == "01.01.") {
		if(!checkAdmin()) {
			$welcome = "Frohes neues Jahr wünscht dir die Geschäftsleitung!";
		} else {
			$welcome = "New Yearhhh!, Admin";
		}
    }

    echo "$welcome";
}

// DEBBUGING ==================================================================================================

function emailValidation($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function phoneValidation($phone) {
    return preg_match("/^\+?([0-9]{2})\)?([0-9]{8,13})$/", $phone);
}

function bonValidation($bon) {
    return preg_match("/^([0-9]{4,8})$/", $bon);
}

function bonDateValidation($bondate) {
    return preg_match("/^(\d{2}).(\d{2}).(\d{4})$/", $bondate);
}
?>
