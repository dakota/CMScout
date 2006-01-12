<?php
/* SVN FILE: $Id$ */

/**
 * The main "loop"
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright (c) 2005, Cake Software Foundation, Inc.
 *                     1785 E. Sahara Avenue, Suite 490-204
 *                     Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright    Copyright (c) 2005, Cake Software Foundation, Inc.
 * @link         http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package      cake
 * @subpackage   cake.cake.app.webroot
 * @since        CakePHP v 0.2.9
 * @version      $Revision$
 * @modifiedby   $LastChangedBy$
 * @lastmodified $Date$
 * @license      http://www.opensource.org/licenses/mit-license.php The MIT License
 */


/**
 * Get Cake's root directory
 */
if (!defined('DS'))
{
/**
 * Enter description here...
 */
   define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('ROOT'))
{
/**
 * Enter description here...
 *
 */
    define('ROOT', dirname(dirname(dirname(__FILE__))).DS);
}

if (!defined('APP_DIR'))
{
    define ('APP_DIR', basename(dirname(dirname(__FILE__))));
}

if (!defined('WEBROOT_DIR'))
{
    define ('WEBROOT_DIR', basename(dirname(__FILE__)));
}


/**
 * Configuration, directory layout and standard libraries
 */
require_once ROOT.'cake'.DS.'basics.php';
require_once ROOT.APP_DIR.DS.'config'.DS.'core.php';
require_once ROOT.'cake'.DS.'config'.DS.'paths.php';
require_once LIBS.'object.php';
require_once LIBS.'session.php';
require_once LIBS.'security.php';
require_once LIBS.'neat_array.php';
require_once LIBS.'inflector.php';

/**
 * Enter description here...
 */

    if (empty($uri) && defined('BASE_URL'))
    {
        $uri = setUri();
        if ($uri === '/' || $uri === '/index.php' || $uri === '/app/')
        {
            $_GET['url'] = '/';
            $url = '/';
        }
        else
        {
            $elements = explode('/index.php', $uri);
            if(!empty($elements[1]))
            {
                $_GET['url'] = $elements[1];
                $url = $elements[1];
            }
            else
            {
                $_GET['url'] = '/';
                $url = '/';
            }
        }
    }
    else
    {
        $url = empty($_GET['url'])? null: $_GET['url'];
    }


if (strpos($url, 'ccss/') === 0)
{
   include WWW_ROOT.DS.'css.php';
   die();
}


DEBUG? error_reporting(E_ALL): error_reporting(0);
if (DEBUG)
{
    ini_set('display_errors', 1);
}

$TIME_START = getMicrotime();

require_once CAKE.'dispatcher.php';
require_once LIBS.'model'.DS.'connection_manager.php';

config('database');

if (class_exists('DATABASE_CONFIG') && !class_exists('AppModel'))
{
    require_once LIBS.'model'.DS.'model.php';
    loadModels();
}

//RUN THE SCRIPT
   if(isset($_GET['url']) && $_GET['url'] === 'favicon.ico')
   {
   }else{
      $Dispatcher= new Dispatcher ();
      $Dispatcher->dispatch($url);
   }

if (DEBUG) {
    echo "<!-- ". round(getMicrotime() - $TIME_START, 2) ."s -->";
}
?>