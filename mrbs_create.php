<?php
// +---------------------------------------------------------------------------+
// | Meeting Room Booking System.
// +---------------------------------------------------------------------------+
// | MRBS Database Installation script
// |---------------------------------------------------------------------------+
// | Copy mrbs_create.php into your web site and run it.
// +---------------------------------------------------------------------------+
// | @author    thierry_bo.
// | @version   $Revision$.
// +---------------------------------------------------------------------------+
//
// $Id$

/**************************
* Database settings
* You shouldn't have to modify anything outside this section.
**************************/

// Choose database system: see INSTALL for the list of supported databases
// ("mysql"=MySQL,...) and valid strings.
$dbsys = "mysql";

// Hostname of database server  :
$db_host = "localhost";

// Port of database server. Leave empty to use default for the database
$db_port = "";

// Database name:
$db_database = "mrbs";

// Database login user name:
$db_login = "mrbs";

// Database login password:
$db_password = "mrbs-password";

// Boolean flag that indicates whether the database should be created or use a
// previously installed database of the same name. Another circumstance on
// which this flag may have to be set to FALSE is when the DBMS driver does
// not support database creation or if this operation requires special
// database administrator permissions that may not be available to the
// database user.
// Set $db_create to FALSE to NOT create the database.
$db_create = TRUE;

// Communication protocol tu use. For pgsql, you can use 'unix' instead of
// 'tcp' to use Unix Domain Sockets instead of TCP/IP.
$db_protocol = "tcp";

/**************************
* End of database settings
***************************/

include_once("MDB.php");
MDB::loadFile("Manager");

$schema_file = "mrbs.schema.xml";
$variables = array
(
	"database_name"   => $db_database,
    "database_create" => $db_create
);
$dsn = array
(
	"phptype"  => $dbsys,
    "username" => $db_login,
    "password" => $db_password,
    "hostspec" => $db_host,
    "protocol" => $db_protocol,
    "port"	   => $db_port
);
$manager = new MDB_manager;
$manager->connect($dsn);
$success = $manager->updateDatabase($schema_file, $schema_file . ".before", $variables);
if (MDB::isError($success))
{
	echo "Error: " . $success->getMessage() . "\n";
    echo "Error: " . $success->getUserInfo() . "\n";
}
if (count($manager->warnings)>0)
{
	echo "WARNING:\n",implode($manager->getWarnings(),"!\n"),"\n";
}

?>