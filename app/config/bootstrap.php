<?php
/* SVN FILE: $Id: bootstrap.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 20:16:01 -0600 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */
$viewPaths = array(WWW_ROOT);

/**
 * This function calls a specific hook out of any plugin's hooks.php that matches $pluginFilter
 * The list of hooks.php files get's cached for a certain time depending on the value of DEBUG.
 * The 3rd argument &$caller has to be a reference to the caller/variable that get's affected by
 * the Hook.
 *
 * @param string $hook
 * @param string $pluginFilter
 * @param mixed $caller
 */
function callHooks($hook, $pluginFilter = '.+', &$caller)
{
    // pluginHooks contains an array of plugins that provide a hook File
    static $hookPlugins = array();
    
    if (empty($pluginFilter))
        $pluginFilter = '.+';
        
    $params = func_get_args();
    
    // Get rid of $hook, $pluginFilter and &$caller in our $params array
    array_shift($params);
    array_shift($params);
    array_shift($params);
        
 	$hookReturns = array();
    if (empty($hookPlugins))
    {
        $cachePath = 'hook_files';
        
        $debug = Configure::read('debug');
        
        if ($debug==3)
            $cacheExpires = '+5 seconds';
        elseif ($debug==1 || $debug==2)
            $cacheExpires = '+60 seconds';
        else 
            $cacheExpires = '+24 hours';
            
        $hookFiles = cache($cachePath, null, $cacheExpires);
        
        if (empty($hookFiles))
        {
            uses('Folder');        
            $Folder =& new Folder(APP.'plugins');
            $hookFiles = $Folder->findRecursive('hooks.php');
            
            cache($cachePath, serialize($hookFiles));
        }        
        else
            $hookFiles = unserialize($hookFiles);
                    
        
        foreach ($hookFiles as $hookFile)
        {
            list($plugin) = explode(DS, substr($hookFile, strlen(APP.'plugins'.DS)));                
            require($hookFile);
            
            $hookPlugins[] = $plugin;
            
            if (preg_match('/'.$pluginFilter.'/iUs', $plugin))
            {
                $hookFunction = $plugin.$hook.'Hook';
                if (function_exists($hookFunction))
                {
                    $hookReturns[] = call_user_func_array($hookFunction, am(array(&$caller), $params));
                }
            }
        }        
    }
    else 
    {
        foreach ($hookPlugins as $plugin)
        {
            if (preg_match('/'.$pluginFilter.'/iUs', $plugin))
            {
                $hookFunction = $plugin.$hook.'Hook';                    
                if (function_exists($hookFunction))
                {
                    $hookReturns[] = call_user_func_array($hookFunction, am(array(&$caller), $params));
                }
            }                   
        }
    }
    
    return $hookReturns;
}

//EOF
?>