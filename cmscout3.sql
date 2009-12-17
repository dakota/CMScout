-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2009 at 07:54 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `cmscout3`
--

--
-- Dumping data for table `cms_acos`
--

INSERT INTO `cms_acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `explanation`, `lft`, `rght`) VALUES
(1, NULL, '', NULL, 'Administration panel', 'Admin|Access administrative functions', 1, 18),
(2, 1, '', NULL, 'Configuration', '0,Access configuration manager,Change configuration options', 2, 3),
(3, 1, '', NULL, 'Menus', '0,Access menu manager,Edit menus', 4, 5),
(4, 1, '', NULL, 'Plugins', 'Enabled/disable plugins,Access plugin manager', 6, 7),
(5, 1, '', NULL, 'Users', 'Add new user,0,Edit users,Delete users', 8, 9),
(6, 1, '', NULL, 'Groups', 'Add new group,0,Edit groups,Delete groups', 10, 11),
(7, 1, '', NULL, 'User groups', '0,0,Edit user groups', 12, 13),
(8, 1, '', NULL, 'UGP Manager', '0,Access UGP manager,Edit permissions', 14, 15),
(9, 1, '', NULL, 'Taxonomy', 'read|Access taxonomy manager', 16, 17),
(10, NULL, '', NULL, 'Sideboxes', '0,Sidebox visible', 19, 20),
(11, NULL, '', NULL, 'Notifications', '0,Allowed to subscribe', 21, 22),
(12, NULL, '', NULL, 'Contributions', 'Add item,0,Update item,Delete item,0,Published by default', 23, 24);

--
-- Dumping data for table `cms_aros`
--

INSERT INTO `cms_aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, '', NULL, 'Groups', 1, 6),
(2, 1, 'Group', 1, '', 2, 3),
(3, 1, 'Group', 2, '', 4, 5),
(4, NULL, '', NULL, 'Users', 9, 16),
(5, 4, 'User', 1, '', 10, 11),
(6, 4, 'User', 2, '', 12, 13),
(7, NULL, '', NULL, 'Guest', 7, 8),
(8, 4, 'User', 3, '', 14, 15);

--
-- Dumping data for table `cms_aros_acos`
--

INSERT INTO `cms_aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`, `_admin`) VALUES
(1, 2, 1, '0', '0', '0', '0', '1'),
(2, 2, 2, '0', '1', '1', '0', '0'),
(3, 2, 3, '0', '1', '1', '0', '0'),
(4, 2, 4, '1', '1', '0', '0', '0'),
(5, 2, 5, '1', '0', '1', '1', '0'),
(6, 2, 6, '1', '0', '1', '1', '0'),
(7, 2, 7, '0', '0', '1', '0', '0'),
(8, 2, 8, '0', '1', '1', '0', '0'),
(9, 2, 9, '0', '1', '0', '0', '0');

--
-- Dumping data for table `cms_configuration`
--

INSERT INTO `cms_configuration` (`id`, `name`, `value`, `category_name`, `input_type`, `options`, `label`, `order`, `auto_edit`, `plugin_id`) VALUES
(1, 'SiteName', 'CMScout3', 'Core', 'text', '', 'Website name', 1, 1, NULL),
(2, 'SiteEmail', 'webmaster@mysite.com', 'Email', 'text', '', 'Website email address', 1, 1, NULL),
(3, 'Disabled', '0', 'Core', 'checkbox', '', 'Website disabled', 4, 1, NULL),
(4, 'Captcha', '1', 'Core', 'checkbox', '', 'Enable CAPTCHA image', 6, 1, NULL),
(5, 'DisableReason', 'This is a reason', 'Core', 'textarea', '', 'Reason for disabled website', 5, 1, NULL),
(6, 'AvatarSize', '100', 'Core', 'number', '', 'Longest side of an avatar', 7, 1, NULL),
(7, 'SiteTag', 'The easiest CMScout by far', 'Core', 'text', '', 'Website tag', 2, 1, NULL),
(11, 'EmailPrefix', '[CMScout3]', 'Email', 'text', '', 'Email Prefix', 2, 1, NULL),
(12, 'EnableEmails', '1', 'Email', 'checkbox', '', 'Enable Emails', 3, 1, NULL),
(13, 'SMTPHost', '', 'Email', 'text', '', 'SMTP Host/Server', 5, 1, NULL),
(14, 'SMTPPort', '25', 'Email', 'number', '', 'SMTP Port', 6, 1, NULL),
(15, 'SMTPUsername', '', 'Email', 'text', '', 'SMTP Username', 7, 1, NULL),
(16, 'SMTPPassword', '', 'Email', 'password', '', 'SMTP Password', 8, 1, NULL),
(17, 'AllowRegistration', '1', 'Registration', 'checkbox', '', 'Allow registration', 1, 1, NULL),
(18, 'DuplicateEmail', '1', 'Registration', 'checkbox', '', 'Duplicate email', 2, 1, NULL),
(19, 'AccountActivation', '1', 'Registration', 'select', 'No activation,User activation,Administrator activation', 'Account Activation', 3, 1, NULL),
(20, 'SMTP', '0', 'Email', 'checkbox', '', 'Use SMTP', 4, 1, NULL),
(25, 'homePage', '', 'Core', '', '', '', 0, 0, NULL),
(26, 'themeId', '', 'Core', '', '', '', 0, 0, NULL),
(27, 'homePageOption', '', 'Core', '', '', '', 0, 0, NULL);

--
-- Dumping data for table `cms_groups`
--

INSERT INTO `cms_groups` (`id`, `title`, `protected`, `members_protected`) VALUES
(1, 'Administrators', '1', ''),
(2, 'All users', '1', '1');

--
-- Dumping data for table `cms_groups_users`
--

INSERT INTO `cms_groups_users` (`id`, `group_id`, `user_id`) VALUES
(1, 1, 1),
(4, 2, 1),
(5, 2, 3);

--
-- Dumping data for table `cms_menus`
--

INSERT INTO `cms_menus` (`id`, `title`, `plugin`, `controller`, `action`, `edit_action`, `options`, `sidebox`, `menu_id`, `order`) VALUES
(1, 'Homepage', NULL, 'homepages', 'index', '', 'a:0:{}', 0, 'menu1', 1),
(2, 'Login', NULL, '', 'login', '', 'N;', 1, 'menu3', 1),
(3, 'User Control Panel', NULL, 'users', 'index', '', 'a:0:{}', 0, 'menu1', 2),
(4, 'Online Users', NULL, '', 'online', '', 'N;', 1, 'menu3', 2);

--
-- Dumping data for table `cms_notifications`
--

INSERT INTO `cms_notifications` (`id`, `plugin_id`, `name`, `type`, `title`, `subject`) VALUES
(1, NULL, 'new_user', 'email', 'New User', 'A new user has just registered'),
(2, NULL, 'registration_info', 'email', 'Registration information', 'Your registration'),
(3, NULL, 'user_status', 'email', 'User Status', 'Your account status has been changed');

--
-- Dumping data for table `cms_notifications_users`
--


--
-- Dumping data for table `cms_plugins`
--


--
-- Dumping data for table `cms_themes`
--


--
-- Dumping data for table `cms_users`
--

INSERT INTO `cms_users` (`id`, `username`, `password`, `first_name`, `last_name`, `email_address`, `active`, `created`, `last_login`, `avatar`, `signature`, `public_profile`, `show_name`, `show_email`, `deleted`, `deleted_date`) VALUES
(1, 'admin', 'aa14740187e460cadfea631eea3d817c005d2757', 'admin', 'user', 'admin@cmscout.co.za', 1, NULL, NULL, 'irene-logo0.jpg', 'Test', 1, 1, 0, 0, NULL),
(2, 'test', 'aa14740187e460cadfea631eea3d817c005d2757', '', '', 'testUser@cmscout.co.za', 1, '2009-05-08 14:09:27', NULL, NULL, '', 1, 1, 0, 0, '2009-06-04 22:56:00'),
(3, 'bla', 'aa14740187e460cadfea631eea3d817c005d2757', '', '', 'sdf@dgs.com', 0, '2009-10-29 08:56:05', NULL, NULL, '', 1, 1, 0, 0, NULL);
