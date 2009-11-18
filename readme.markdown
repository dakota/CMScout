# Requirements
You need the following in order to use CMScout3:
-	Apache with mod_rewrite running and .htaccess files should be allowed.
-	PHP > version 5

Currently CMScout 3 has only been tested with:
-	Apache v2.2.11
-	PHP v5.2.x and v5.3.x
-	MySQL 5.1.x

# Installing
To install CMScout3 to work do the following (assuming you already have cloned the git repository):
-	Get the CakePHP core (You can clone git://github.com/dakota/cakephp-fork.git)
-	Where the CakePHP core is, doesn't really matter.
-	Open cmscout/webroot/index.php and edit line 53 to match the absolute location of the CakePHP core.
-	Next, you need to grab the submodules - The only one that is currently **required** is debugKit
-	In your git command prompt, type `git submodule init`, followed by `git submodule update`. Git should then fetch all the submodules.
-	Create a database
-	Import the cmscout3.sql file into the database
-	Create/Edit cmscout/config/database.php and insert/change the following (Changing where necessary):

	<?php
		class DATABASE_CONFIG {

			var $default = array(
				'driver' => 'mysql',
				'persistent' => false,
				'host' => 'localhost',
				'login' => 'root',
				'password' => '',
				'database' => 'cmscout3',
				'prefix' => 'cms_',
			);
		}
	?>
	
-	The default username/password for CMScout3 is admin/123456
-	Enjoy

# License
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

# CakePHP
For more information about the CakePHP framework goto www.cakephp.org.

# Help us!
CMScout desperately needs developers and people willing to do themes and documentation. If you interested please let us know at cmscout.co.za.