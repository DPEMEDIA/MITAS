<?php
// ===================================
// Start Session
// ===================================
session_start();

// ===================================
// Show all PHP Errors
// ===================================
error_reporting(-1);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL ^ E_NOTICE);

// ===================================
// Set Local Time / German
// ===================================
setlocale(LC_TIME, "de_DE.utf8");

// ===================================
// Define Database
// ===================================
define("DBHOST", "localhost");
define("DBNAME", "d02dae96");
define("DBPASS", "Southball1");
define("DBUSER", "d02dae96");

// ===================================
// Create Connection
// ===================================
$Server = (object) array(
	"query" => @mysqli_connect(DBHOST, DBNAME, DBPASS, DBUSER),
	"session" => "userid",
	"timestamp" => time(),
	"name" => "Mitarbeitersystem",
	"version" => "V. 0.1",
);

global $Server;

// Special Characters
mysqli_set_charset($Server->query, "utf8mb4");

// ===================================
// Check Connection
// ===================================
if (mysqli_connect_errno()) {
	die("Konnte keine Verbindung zur Datenbank aufbauen: ".mysqli_connect_error()."(".mysqli_connect_errno().")");
}

// ===================================
// MYSQL FUNCTIONS
// ===================================
function MysqlSelect($query) {
	if($query) {
		global $Server;
		return mysqli_query($Server->query, $query);
	}
}
    
function MysqlInsert($query) {
	if($query) {
		global $Server;
		if(mysqli_query($Server->query, $query)) {
			return mysqli_insert_id($Server->query);
		} else {
			return mysqli_error($Server->query);
        }
    }
}
    
function MysqlUpdate($query) {
	if($query) {
		global $Server;
		return mysqli_query($Server->query, $query);
	}
}
    
function MysqlDelete($query) {
	if($query) {
		global $Server;
		return mysqli_query($Server->query, $query);
	}
}
    
function MysqlEscape($query) {
	if($query) {
		global $Server;
		return mysqli_real_escape_string($Server->query, $query);
	}
}

// ===================================
// NOT SO GOOD FOR WHILE
// ===================================
function MysqlArray($query) {
	if($query) {
		return mysqli_fetch_array($query);
    }
}
    
// ===================================
// WHILE
// ===================================
function MysqlAssoc($query) {
	if($query) {
		return mysqli_fetch_assoc($query);
	}
}
    
function MysqlNumRow($query) {
	if($query) {
		return mysqli_num_rows($query);
	}
}

// ===================================
// MYSQL ERROR
// ===================================
function MysqlError() { 
	global $Server;
	return mysqli_error($Server->query);
}
    
function MysqlErrno() {
	global $Server;
	return mysqli_errno($Server->query);
}
?>