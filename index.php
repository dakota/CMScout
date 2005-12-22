<?php
/* SVN FILE: $Id$ */

/**
 * Requests collector.
 * 
 *  This file collects requests if:
 *    - no mod_rewrite is avilable or .htaccess files are not supported
 *    - /public is not set as a web root.
 *
 * PHP versions 4 and 5
 *
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright (c) 2005, CakePHP Authors/Developers
 *
 * Author(s): Michal Tatarynowicz aka Pies <tatarynowicz@gmail.com>
 *            Larry E. Masters aka PhpNut <nut@phpnut.com>
 *            Kamil Dzielinski aka Brego <brego.dk@gmail.com>
 *
 *  Licensed under The MIT License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource 
 * @author       CakePHP Authors/Developers
 * @copyright    Copyright (c) 2005, CakePHP Authors/Developers
 * @link         https://trac.cakephp.org/wiki/Authors Authors/Developers
 * @package      cake
 * @since        CakePHP v 0.2.9
 * @version      $Revision$
 * @modifiedby   $LastChangedBy$
 * @lastmodified $Date$
 * @license      http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 *  Get Cake's root directory
 */
define ('APP_DIR', 'app');
define ('DS', DIRECTORY_SEPARATOR);
define ('ROOT', dirname(__FILE__).DS);

require_once ROOT.'cake'.DS.'basics.php';
require_once ROOT.APP_DIR.DS.'config'.DS.'core.php';
require_once ROOT.'cake'.DS.'config'.DS.'paths.php';


$uri = setUri();

/**
 * As mod_rewrite (or .htaccess files) is not working, we need to take care
 * of what would normally be rewritten, i.e. the static files in /public
 */
if ($uri === '/' || $uri === '/index.php')
{
    $_GET['url'] = '/';
    require_once ROOT.APP_DIR.DS.WEBROOT_DIR.DS.'index.php';
}
else
{
    $elements = explode('/index.php', $uri);

    if(!empty($elements[1]))
    {
        $path = $elements[1];
    }
    else
    {
        $path = '/';
    }

    $_GET['url'] = $path;

    require_once ROOT.APP_DIR.DS.WEBROOT_DIR.DS.'index.php';
}
?>