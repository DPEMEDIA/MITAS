<?php
if(isset($_GET["include"])) {
	// Inhalte anzeigen
	$include = $_GET["include"];
	
	if(file_exists("inc/page/$include.php")) {
		// Include - Normal
		require_once("inc/page/$include.php");
	} elseif(file_exists("inc/panel/$include.php"))	{
		// Include - Panel
		require_once("inc/panel/$include.php");
	} else {
		// Fehler ausgeben
		require_once("inc/page/error.php");
	}
} else {
	require_once("inc/page/content.php");
}
?>