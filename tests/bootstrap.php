<?php

//  define('ENVIRONMENT', 'testing');

/*
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 * NO TRAILING SLASH!
 *
 * The test should be run from inside the tests folder.  The assumption
 * is that the tests folder is in the same directory path as system.  If
 * it is not, update the paths appropriately.
 */

$system_path = '../system';
$application_folder = '../application';
$view_folder = '';





define('DS', DIRECTORY_SEPARATOR);

/*
 *---------------------------------------------------------------
 * PHP ERROR REPORTING LEVEL
 *---------------------------------------------------------------
 *
 * By default CI runs with error reporting set to ALL.  For security
 * reasons you are encouraged to change this to 0 when your site goes live.
 * For more info visit:  http://www.php.net/error_reporting
 *
 */
    error_reporting(E_ALL);

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

    // Set the current directory correctly for CLI requests
    if (defined('STDIN')) {
        chdir(dirname(__FILE__));
    }

    if (realpath($system_path) !== FALSE) {
        $system_path = realpath($system_path) . DS;
    }

    // ensure there's a trailing slash
    $system_path = rtrim($system_path, '/') . DS;

    // Is the system path correct?
    if (!is_dir($system_path)) {
        exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: " . pathinfo(__FILE__, PATHINFO_BASENAME));
    }

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */

// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// The PHP file extension
// this global constant is deprecated.
define('EXT', '.php');

// Path to the system folder
define('BASEPATH', str_replace("\\", "/", $system_path));

// Path to the front controller (this file)
define('FCPATH', str_replace(SELF, '', __FILE__));

// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));


// The path to the "application" folder
if (is_dir($application_folder)) {
    define('APPPATH', $application_folder . DS);
}
else
{
    if (!is_dir(BASEPATH . $application_folder . DS)) {
        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF);
    }

    define('APPPATH', BASEPATH . $application_folder . DS);
}

// The path to the "views" folder
if (is_dir($view_folder)) {
    define ('VIEWPATH', $view_folder . DS);
}
else
{
    if (!is_dir(APPPATH . 'views/')) {
        exit("Your view folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF);
    }

    define ('VIEWPATH', APPPATH . 'views/');
}

/*
 * --------------------------------------------------------------------
 * LOAD THE CITOOLS BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 */

require_once APPPATH . '/../application/libraries/CITools/bootstrap.php';


/*
 * --------------------------------------------------------------------
 * REQUIRE COMPOSER FOLDERS
 * --------------------------------------------------------------------
 *
 */

require_once BASEPATH . '/../vendor' . DS . 'autoload.php';

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 *
 */

//require_once BASEPATH . 'core/CodeIgniter.php';

/* End of file bootstrap.php */
/* Location: .//D/projects/ci-code-generator/tests/bootstrap.php */