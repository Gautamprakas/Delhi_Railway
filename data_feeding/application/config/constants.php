<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*PROJECT DETAILS*/
define('PROJECT_NAME','Railway');
define('LOGO','Railway');


define('THEME_BLUE_GREY','theme-cyan');
define('BG_BLUE_GREY','bg-cyan');
define('PL_BLUE_GREY','pl-cyan');
define('MY_CLASS','myClass');

define('SMSUPLOADNO','9936785057');
define('APPLINK','http://vdsai.com');


/*Project Setup Start*/
/*define('BASE_URL','http://vdsai.com/kanpurneeds/service_provider');
define('DB_HOST','localhost');
define('DB_PORT',3306);
define('DB_USER_NAME','vdsai_sam');
define('DB_PASSWORD','Vdai@1234db#');
define('DB_NAME','kanpurneeds');*/

date_default_timezone_set('Asia/Kolkata');

define('BASE_URL','http://localhost/railway/data_feeding');
define('DB_HOST','localhost');
define('DB_PORT',3306);
define('DB_USER_NAME','root');
define('DB_PASSWORD','');
define('DB_NAME','vdsai_railway');
define('FMAILY_FROM_ID','1690365766');
define('MEMBER_FROM_ID','1690455293241');

define("SELECT_ITEMS_FOR_WORK","1690365766B");
define("APPROVAL_OR_REJECTION_FROM_CONCERN_RAILWAY_PERSON","1695199672079");
define("STORE_RELEASE_ITEMS","1695202363076");
define("INCHARGE_USER_ACCEPT_OF_ISSUED_ITEM","1695203798965");
define("USER_WORK_DONE_ACTION","1690450752274");
define("RATING_FROM_RAILWAY","1695204093088");

define("FORMSELECT_SELECT_ITEMS_FOR_WORK","1690365766B_1");
define("FORMSELECT_APPROVAL_OR_REJECTION_FROM_CONCERN_RAILWAY_PERSON","1695199672079_1");
define("FORMSELECT_STORE_RELEASE_ITEMS","1695202363076_1");
define("FORMSELECT_INCHARGE_USER_ACCEPT_OF_ISSUED_ITEM","1695203798965_1");
define("FORMSELECT_USER_WORK_DONE_ACTION","1690450752274_1");
define("FORMSELECT_RATING_FROM_RAILWAY","1695204093088_1");

define("SELECT_ITEMS_FOR_WORK_ITEM_QUANTITY","1690365766B_3");

define("TRAIN_NUMBER_FIELD_ID","1690365766_1");

define("FORMASSOCARR",json_encode(array(
SELECT_ITEMS_FOR_WORK=>FORMSELECT_SELECT_ITEMS_FOR_WORK,
APPROVAL_OR_REJECTION_FROM_CONCERN_RAILWAY_PERSON=>FORMSELECT_APPROVAL_OR_REJECTION_FROM_CONCERN_RAILWAY_PERSON,
STORE_RELEASE_ITEMS=>FORMSELECT_STORE_RELEASE_ITEMS,
INCHARGE_USER_ACCEPT_OF_ISSUED_ITEM=>FORMSELECT_INCHARGE_USER_ACCEPT_OF_ISSUED_ITEM,
USER_WORK_DONE_ACTION=>FORMSELECT_USER_WORK_DONE_ACTION,
RATING_FROM_RAILWAY=>FORMSELECT_RATING_FROM_RAILWAY
)));
/*Project Setup End*/