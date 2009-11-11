<?php
<<<<<<< HEAD
/* SVN FILE: $Id$ */

=======
>>>>>>> cake1.3/1.3
/**
 *
 * PHP versions 4 and 5
 *
<<<<<<< HEAD
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
=======
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
>>>>>>> cake1.3/1.3
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
<<<<<<< HEAD
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
=======
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
>>>>>>> cake1.3/1.3
 */
?>
<h2><?php __('Missing Helper Class'); ?></h2>
<p class="error">
	<strong><?php __('Error'); ?>: </strong>
<<<<<<< HEAD
	<?php echo sprintf(__("The helper class <em>%s</em> can not be found or does not exist.", true), $helperClass);?>
</p>
<p  class="error">
	<strong><?php __('Error'); ?>: </strong>
	<?php echo sprintf(__('Create the class below in file: %s', true), APP_DIR . DS . "views" . DS . "helpers" . DS . $file);?>
=======
	<?php echo sprintf(__('The helper class <em>%s</em> can not be found or does not exist.', true), $helperClass);?>
</p>
<p  class="error">
	<strong><?php __('Error'); ?>: </strong>
	<?php echo sprintf(__('Create the class below in file: %s', true), APP_DIR . DS . 'views' . DS . 'helpers' . DS . $file);?>
>>>>>>> cake1.3/1.3
</p>
<pre>
&lt;?php
class <?php echo $helperClass;?> extends AppHelper {

}
?&gt;
</pre>
<p class="notice">
	<strong><?php __('Notice'); ?>: </strong>
<<<<<<< HEAD
	<?php echo sprintf(__('If you want to customize this error message, create %s', true), APP_DIR . DS . "views" . DS . "errors" . DS . "missing_helper_class.ctp");?>
=======
	<?php echo sprintf(__('If you want to customize this error message, create %s', true), APP_DIR . DS . 'views' . DS . 'errors' . DS . 'missing_helper_class.ctp');?>
>>>>>>> cake1.3/1.3
</p>