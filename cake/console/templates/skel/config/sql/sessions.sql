# $Id$
#
<<<<<<< HEAD
# Copyright 2005-2008,	Cake Software Foundation, Inc.
=======
# Copyright 2005-2009,	Cake Software Foundation, Inc.
>>>>>>> cake1.3/1.3
#								1785 E. Sahara Avenue, Suite 490-204
#								Las Vegas, Nevada 89104
#
# Licensed under The MIT License
# Redistributions of files must retain the above copyright notice.
<<<<<<< HEAD
# http://www.opensource.org/licenses/mit-license.php The MIT License
=======
# MIT License (http://www.opensource.org/licenses/mit-license.php)
>>>>>>> cake1.3/1.3

CREATE TABLE cake_sessions (
  id varchar(255) NOT NULL default '',
  data text,
  expires int(11) default NULL,
  PRIMARY KEY  (id)
);