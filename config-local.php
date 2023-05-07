<?php

/**
 * The base MySQL settings of Osclass
 */
define('MULTISITE', 0);

/** MySQL database name for Osclass */
define('DB_NAME', 'zzbeng_osclass');

/** MySQL database username */
define('DB_USER', 'zzbeng_osclass');

/** MySQL database password */
define('DB_PASSWORD', '_15o+CQU;D0N');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Table prefix */
define('DB_TABLE_PREFIX', 'oc_');

define('REL_WEB_URL', '/');

define('WEB_PATH', 'http://localhost:8000/');

session_set_cookie_params(0);
ini_set('session.gc_maxlifetime', 0);

//define('OSC_DEBUG', true);
 //define('OSC_DEBUG_DB', true);
//define('OSC_DEBUG_LOG', true);

?>