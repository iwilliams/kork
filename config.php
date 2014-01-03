<?php

/**
 * Debug variable.
 */
define('DEBUG', 'false');

/**
 * Configuration for the MYSQL and PSQL Database. If you enable MYSQL do not
 * enable any other databases.
 *
**/

// Set only one of the following to true
define('DB_MYSQL', 'true'); // Use MYSQL Database
define('DB_PSQL', 'false'); // Use PostgreSQL database

if (DB_MYSQL) {
	define('MYSQL_HOST', 'local.dev');
	define('MYSQL_USER', 'root');
	define('MYSQL_PASSWORD', '');
	define('MYSQL_DB', 'board');
} else if (DB_PSQL) {
	define('PSQL_HOST', 'localhost');
	define('PSQL_USER', 'usernamehere');
	define('PSQL_PASSWORD', 'yourpasswordhere');
	define('PSQL_DB', 'putyourdbnamehere');
}


?>