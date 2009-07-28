You need the following in order to use CMScout3:
*Apache with mod_rewrite running and .htaccess files should be allowed.
*PHP > version 5

Currently CMScout 3 has only been tested with:
*Apache v2.2.11
*PHP v5.2.8 and v5.2.9-2
*MySQL 5.1.30 and 5.1.33

To get CMScout3 to work do the following:
*Create a database
*Import the cmscout3.sql file into the database
*create app/config/database.php and insert the following (Changing where necessary):
	<?php
		class DATABASE_CONFIG {

			var $default = array(
				'driver' => 'mysql',
				'persistent' => false,
				'host' => 'localhost',
				'login' => 'root',
				'password' => '',
				'database' => 'cmscout3',
				'prefix' => '',
			);
		}
	?>
The default username/password for CMScout3 is admin/123456

CMScout3 is licensed under GPL version 3.

    CMScout is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    CMScout is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with CMScout.  If not, see <http://www.gnu.org/licenses/>.
	
For more information about the CakePHP framework goto www.cakephp.org.

CMScout desperatly needs developers and people willing to do themes and documentation. If you interested please let us know at cmscout.co.za.