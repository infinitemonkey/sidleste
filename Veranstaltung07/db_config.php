<?php
# Database
define("CONNECTION_STRING", "mysql:host=localhost;dbname=loc_orm");
define("DB_USER", "loc_orm");
define("DB_PASSWORD", "12341234");

$db = null;

function openDatabase() {
	try {
		return new PDO(CONNECTION_STRING, DB_USER, DB_PASSWORD);
	} catch(PDOException $e) {
		echo $e;
		die ('Could not open connection to '.CONNECTION_STRING);
	}
}

function getDb() {
	global $db;
	if ($db == null) {
		$db = openDatabase();
	}
	return $db;
}


function prepareSql($sql) {
	$pquery = getDb()->prepare($sql);
	return $pquery;
}

function executeSql($pquery, $fieldValueMapping) {
	$pquery->execute($fieldValueMapping);
	return $pquery;
}

?>