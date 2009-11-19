-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 19, 2009 at 09:50 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `cmscout3`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_acos`
--

CREATE TABLE IF NOT EXISTS `cms_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `explanation` mediumtext NOT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `acos_idx1` (`lft`,`rght`),
  KEY `acos_idx2` (`alias`),
  KEY `acos_idx3` (`model`,`foreign_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=20 ;

--
-- Dumping data for table `cms_acos`
--

INSERT INTO `cms_acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `explanation`, `lft`, `rght`) VALUES
(1, NULL, '', NULL, 'Administration panel', 'Admin|Access administrative functions', 1, 18),
(3, 1, '', NULL, 'Menu Manager', '0,Access menu manager,Edit menus', 8, 9),
(5, 1, '', NULL, 'Plugin Manager', 'Install plugin,Access plugin manager,0,Uninstall plugin', 10, 11),
(6, 1, '', NULL, 'Users', 'Add new user,0,Edit users,Delete users', 16, 17),
(7, 1, '', NULL, 'Groups', 'Add new group,0,Edit groups,Delete groups', 6, 7),
(8, 1, '', NULL, 'User groups', '0,0,Edit user groups', 14, 15),
(9, 1, '', NULL, 'UGP Manager', '0,Access UGP manager,Edit permissions', 12, 13),
(10, 1, '', NULL, 'Core Configuration', '0,Access configuration manager,Change configuration options', 2, 3),
(12, NULL, '', NULL, 'Plugins', '0,Access configuration', 25, 28),
(13, NULL, '', NULL, 'Sideboxes', '0,Sidebox visible', 29, 30),
(14, NULL, '', NULL, 'Notifications', '0,Allowed to subscribe', 23, 24),
(15, NULL, '', NULL, 'Contributions', 'Add item,0,Update item,Delete item,0,Published by default', 21, 22),
(17, 12, 'Plugin', 120541, '', '', 26, 27),
(18, 1, '', NULL, 'Forum Manager', 'Create|Create forums,Read|Access Forum Manager,Update|Edit forums,Delete|Delete forums', 4, 5),
(19, NULL, '', NULL, 'CMScout Forums', 'Create|Post new thread,Read|View forum,Update|Edit own posts,Delete|Delete own posts,Reply|Reply to thread,Moderate|Moderate Forum,Sticky|Create stick threads,Announcement|Create announcement threads', 19, 20);

-- --------------------------------------------------------

--
-- Table structure for table `cms_api_classes`
--

CREATE TABLE IF NOT EXISTS `cms_api_classes` (
  `id` varchar(36) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `file_name` text,
  `method_index` text,
  `property_index` text,
  `flags` int(5) DEFAULT '0',
  `coverage_cache` float(4,4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_api_classes`
--

INSERT INTO `cms_api_classes` (`id`, `name`, `slug`, `file_name`, `method_index`, `property_index`, `flags`, `coverage_cache`, `created`, `modified`) VALUES
('4a2cea97-1258-4a01-804d-077cc90e2450', 'AppController', 'app-controller', 'D:\\wamp\\www\\cmscout\\app\\app_controller.php', 'beforefilter beforerender beforefilter beforerender', 'theme menuadminmode _isajax session aclextend auth notification theme menuadminmode _isajax session aclextend auth notification', 2, NULL, '2009-06-08 13:40:23', '2009-06-08 13:40:23'),
('4a2cea97-f18c-42dc-9cb6-077cc90e2450', 'L10n', 'l10n', 'D:\\wamp\\www\\cmscout\\cake\\libs\\l10n.php', '__construct get __setlanguage __autolanguage map catalog __construct get __setlanguage __autolanguage map catalog', 'language languagepath lang locale default charset found __l10nmap __l10ncatalog language languagepath lang locale default charset found __l10nmap __l10ncatalog', 2, NULL, '2009-06-08 13:40:23', '2009-06-08 13:40:23'),
('4a2cea97-1e74-4255-b956-077cc90e2450', 'appModel', 'app-model', 'D:\\wamp\\www\\cmscout\\app\\app_model.php', 'togglefield doesidexist findbyid findbyslug togglefield doesidexist findbyid findbyslug', '', 2, NULL, '2009-06-08 13:40:23', '2009-06-08 13:40:23'),
('4a2cea98-e940-44ff-91d6-077cc90e2450', 'CommentsController', 'comments-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\comments_controller.php', 'post post', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-0a78-4c58-a2f1-077cc90e2450', 'ConfigurationsController', 'configurations-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\configurations_controller.php', 'admin_index admin_index', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-2b70-4630-9fb9-077cc90e2450', 'GroupsController', 'groups-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\groups_controller.php', 'admin_newgroup admin_renamegroup admin_deletegroup admin_loadinformation admin_newgroup admin_renamegroup admin_deletegroup admin_loadinformation', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-44d8-42a4-9b47-077cc90e2450', 'HomepagesController', 'homepages-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\homepages_controller.php', 'beforefilter index admin_index admin_homepage admin_save beforefilter index admin_index admin_homepage admin_save', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-038c-4e8c-b39f-077cc90e2450', 'MenusController', 'menus-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\menus_controller.php', 'admin_index admin_move admin_remove admin_update admin_index admin_move admin_remove admin_update', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-c0d0-4647-a264-077cc90e2450', 'PagesController', 'pages-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\pages_controller.php', 'beforefilter index autotag admin_add admin_edit admin_index admin_trash admin_homepage admin_delete admin_harddelete admin_restore beforefilter index autotag admin_add admin_edit admin_index admin_trash admin_homepage admin_delete admin_harddelete admin_restore', 'page acl page acl', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-1b80-4fa3-86f3-077cc90e2450', 'PluginsController', 'plugins-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\plugins_controller.php', 'admin_index admin_install admin_index admin_install', 'plugin acl plugin acl', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-f014-4b75-93b5-077cc90e2450', 'SearchController', 'search-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\search_controller.php', 'index search doindex index search doindex', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-9804-426e-93e6-077cc90e2450', 'SideboxesController', 'sideboxes-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\sideboxes_controller.php', 'beforefilter admin_menu view beforefilter admin_menu view', 'acl homepage acl homepage', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-d800-48e2-b282-077cc90e2450', 'TagsController', 'tags-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\tags_controller.php', 'index admin_homepage index admin_homepage', 'tag tag', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-06a4-4b41-9c8f-077cc90e2450', 'ThemesController', 'themes-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\themes_controller.php', 'admin_index admin_install admin_sitetheme admin_index admin_install admin_sitetheme', 'theme theme', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-56cc-4dc5-80a4-077cc90e2450', 'UsersController', 'users-controller', 'D:\\wamp\\www\\cmscout\\app\\controllers\\users_controller.php', 'beforefilter login admin_login logout register admin_index admin_loadarotree admin_loadacotree admin_updatepermissions admin_loadpermissions admin_updateusergroups admin_homepage admin_loadinformation admin_togglestatus admin_edit admin_delete index publicprofile profileedit notifications contribute reminder beforefilter login admin_login logout register admin_index admin_loadarotree admin_loadacotree admin_updatepermissions admin_loadpermissions admin_updateusergroups admin_homepage admin_loadinformation admin_togglestatus admin_edit admin_delete index publicprofile profileedit notifications contribute reminder', 'user acl upload user acl upload', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-3448-4e39-b39c-077cc90e2450', 'KeywordsComponent', 'keywords-component', 'D:\\wamp\\www\\cmscout\\app\\controllers\\components\\keywords.php', 'keywordit get_keywords replace_chars parse_words parse_2words parse_3words occure_filter implode keywordit get_keywords replace_chars parse_words parse_2words parse_3words occure_filter implode', 'contents encoding keywords wordlengthmin wordoccuredmin word2wordphraselengthmin phrase2wordlengthminoccur word3wordphraselengthmin phrase2wordlengthmin phrase3wordlengthminoccur phrase3wordlengthmin contents encoding keywords wordlengthmin wordoccuredmin word2wordphraselengthmin phrase2wordlengthminoccur word3wordphraselengthmin phrase2wordlengthmin phrase3wordlengthminoccur phrase3wordlengthmin', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-1074-469c-905f-077cc90e2450', 'loadMenuComponent', 'load-menu-component', 'D:\\wamp\\www\\cmscout\\app\\controllers\\components\\load_menu.php', 'mainmenu mainmenu', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-e2c8-4cf4-bb8f-077cc90e2450', 'NotificationComponent', 'notification-component', 'D:\\wamp\\www\\cmscout\\app\\controllers\\components\\notification.php', 'initialize startup beforerender shutdown beforeredirect _sendemail sendnotification sendindividualnotification initialize startup beforerender shutdown beforeredirect _sendemail sendnotification sendindividualnotification', 'controller components email controller components email', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-566c-4cc6-9cee-077cc90e2450', 'UploadComponent', 'upload-component', 'D:\\wamp\\www\\cmscout\\app\\controllers\\components\\upload.php', 'startup upload ext error image newname uniquename upload_error startup upload ext error image newname uniquename upload_error', '_file _filepath _destination _name _short _rules _allowed errors _file _filepath _destination _name _short _rules _allowed errors', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-4564-485a-8155-077cc90e2450', 'PageEvents', 'page-events', 'D:\\wamp\\www\\cmscout\\app\\events\\models\\page_events.php', 'ongettags ongettagitems onsearch ongetindex ongettags ongettagitems onsearch ongetindex', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-490c-4ac1-be64-077cc90e2450', 'Comment', 'comment', 'D:\\wamp\\www\\cmscout\\app\\models\\comment.php', '', 'actas actas', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-9cc0-4c60-834e-077cc90e2450', 'Configuration', 'configuration', 'D:\\wamp\\www\\cmscout\\app\\models\\configuration.php', 'load saveconfiguration readconfigs load saveconfiguration readconfigs', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-55d0-4239-8326-077cc90e2450', 'Contribution', 'contribution', 'D:\\wamp\\www\\cmscout\\app\\models\\contribution.php', 'parentnode parentnode', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-b99c-4cee-8995-077cc90e2450', 'Group', 'group', 'D:\\wamp\\www\\cmscout\\app\\models\\group.php', 'parentnode parentnode', '', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea98-d3c0-4365-aa4c-077cc90e2450', 'Homepage', 'homepage', 'D:\\wamp\\www\\cmscout\\app\\models\\homepage.php', 'savehomepage savehomepage', 'helpers helpers', 2, NULL, '2009-06-08 13:40:24', '2009-06-08 13:40:24'),
('4a2cea99-af0c-43f1-99f9-077cc90e2450', 'Menu', 'menu', 'D:\\wamp\\www\\cmscout\\app\\models\\menu.php', 'savemenu moveitem insertitem removeitem savemenu moveitem insertitem removeitem', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-5118-49d7-99cf-077cc90e2450', 'MenuLink', 'menu-link', 'D:\\wamp\\www\\cmscout\\app\\models\\menu_link.php', '', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-5ecc-40a4-87ad-077cc90e2450', 'Notification', 'notification', 'D:\\wamp\\www\\cmscout\\app\\models\\notification.php', 'parentnode parentnode', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-5234-48ec-8276-077cc90e2450', 'Page', 'page', 'D:\\wamp\\www\\cmscout\\app\\models\\page.php', 'parentnode gethomepage parentnode gethomepage', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-87f4-42f5-8a52-077cc90e2450', 'Plugin', 'plugin', 'D:\\wamp\\www\\cmscout\\app\\models\\plugin.php', 'parentnode installplugin parentnode installplugin', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-181c-492d-9b4a-077cc90e2450', 'PluginAction', 'plugin-action', 'D:\\wamp\\www\\cmscout\\app\\models\\plugin_action.php', 'fetchlinks fetchlinks', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-4cb4-4c90-a949-077cc90e2450', 'Search', 'search', 'D:\\wamp\\www\\cmscout\\app\\models\\search.php', 'runsearch rebuildindex runsearch rebuildindex', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-37b0-454a-873f-077cc90e2450', 'search.php', 'search.php', 'D:\\wamp\\www\\cmscout\\app\\models\\search.php', 'searchCmp', NULL, 1, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-7adc-4a31-b21a-077cc90e2450', 'SearchIndex', 'search-index', 'D:\\wamp\\www\\cmscout\\app\\models\\search_index.php', 'bindto searchmodels beforefind bindto searchmodels beforefind', 'models models', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-3694-45e6-8a40-077cc90e2450', 'Sidebox', 'sidebox', 'D:\\wamp\\www\\cmscout\\app\\models\\sidebox.php', 'parentnode parentnode', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-2e84-415e-9e87-077cc90e2450', 'Tag', 'tag', 'D:\\wamp\\www\\cmscout\\app\\models\\tag.php', 'gettageditems gettagcloud gethomepage getmenu gettageditems gettagcloud gethomepage getmenu', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-e3d0-4902-b5c0-077cc90e2450', 'Theme', 'theme', 'D:\\wamp\\www\\cmscout\\app\\models\\theme.php', 'installtheme installtheme', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-3b34-44ba-b606-077cc90e2450', 'User', 'user', 'D:\\wamp\\www\\cmscout\\app\\models\\user.php', 'checkunique checkpasswords parentnode isauthorized getnotifications checkunique checkpasswords parentnode isauthorized getnotifications', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-2984-445b-8401-077cc90e2450', 'CommentableBehavior', 'commentable-behavior', 'D:\\wamp\\www\\cmscout\\app\\models\\behaviors\\commentable.php', 'setup fetchcomments savecomment setup fetchcomments savecomment', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-d164-4d29-9836-077cc90e2450', 'ExtendAssociationsBehavior', 'extend-associations-behavior', 'D:\\wamp\\www\\cmscout\\app\\models\\behaviors\\extend_associations.php', 'setup habtmadd habtmdelete habtmdeleteall __habtmfind unbindall setup habtmadd habtmdelete habtmdeleteall __habtmfind unbindall', '', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-1e4c-4080-8ca0-077cc90e2450', 'OrderableBehavior', 'orderable-behavior', 'D:\\wamp\\www\\cmscout\\app\\models\\behaviors\\orderable.php', 'setup beforesave moveup movedown setup beforesave moveup movedown', '__settings __settings', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-0b30-40c6-ac8d-077cc90e2450', 'PublishableBehavior', 'publishable-behavior', 'D:\\wamp\\www\\cmscout\\app\\models\\behaviors\\publishable.php', 'setup setuser enablepublishable beforefind setup setuser enablepublishable beforefind', '__settings __settings', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea99-9ec8-422f-a44f-077cc90e2450', 'ScopedTreeBehavior', 'scoped-tree-behavior', 'D:\\wamp\\www\\cmscout\\app\\models\\behaviors\\scoped_tree.php', 'setup aftersave beforedelete beforesave childcount children generatetreelist getparentnode getpath movedown moveup recover reorder removefromtree verify _setparent __getmax __getmin __sync setup aftersave beforedelete beforesave childcount children generatetreelist getparentnode getpath movedown moveup recover reorder removefromtree verify _setparent __getmax __getmin __sync', 'errors _defaults errors _defaults', 2, NULL, '2009-06-08 13:40:25', '2009-06-08 13:40:25'),
('4a2cea9a-32b4-41a9-8062-077cc90e2450', 'SearchableBehavior', 'searchable-behavior', 'D:\\wamp\\www\\cmscout\\app\\models\\behaviors\\searchable.php', 'setup _indexdata beforesave aftersave _index search setup _indexdata beforesave aftersave _index search', 'model _index _indexforid _defaults searchindex model _index _indexforid _defaults searchindex', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-171c-4fe9-b6eb-077cc90e2450', 'SluggableBehavior', 'sluggable-behavior', 'D:\\wamp\\www\\cmscout\\app\\models\\behaviors\\sluggable.php', 'setup beforesave __slug setup beforesave __slug', '__settings __settings', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-9660-42b8-b8ac-077cc90e2450', 'SoftDeletableBehavior', 'soft-deletable-behavior', 'D:\\wamp\\www\\cmscout\\app\\models\\behaviors\\soft_deletable.php', 'setup beforedelete harddelete purge undelete enablesoftdeletable beforefind beforesave aftersave setup beforedelete harddelete purge undelete enablesoftdeletable beforefind beforesave aftersave', '__settings __settings', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-8ae8-44ef-9a90-077cc90e2450', 'TagBehavior', 'tag-behavior', 'D:\\wamp\\www\\cmscout\\app\\models\\behaviors\\tag.php', 'setup beforesave _parsetag setup beforesave _parsetag', '', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-6bc0-424f-9f1b-077cc90e2450', 'VersionBehavior', 'version-behavior', 'D:\\wamp\\www\\cmscout\\app\\models\\behaviors\\version.php', 'setup beforefind aftersave beforedelete __savenewrevision __updateoldrevision __flatten diff history promote __getdate __shadowexists getversionmodel __checkschema __shadowname revision setup beforefind aftersave beforedelete __savenewrevision __updateoldrevision __flatten diff history promote __getdate __shadowexists getversionmodel __checkschema __shadowname revision', 'date date', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-15f8-4332-99bb-077cc90e2450', 'JsonView', 'json-view', 'D:\\wamp\\www\\cmscout\\app\\views\\json.php', 'render renderjson _jsonencode render renderjson _jsonencode', '', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-4a44-40b2-a1df-077cc90e2450', 'BbcodeHelper', 'bbcode-helper', 'D:\\wamp\\www\\cmscout\\app\\views\\helpers\\bbcode.php', 'parse parse', 'bbcodes htmlcodes htmlcodes_valid bbcodes htmlcodes htmlcodes_valid', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-2d58-4229-a08f-077cc90e2450', 'CssHelper', 'css-helper', 'D:\\wamp\\www\\cmscout\\app\\views\\helpers\\css.php', 'link link', '', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-8c2c-467f-974c-077cc90e2450', 'dateHelper', 'date-helper', 'D:\\wamp\\www\\cmscout\\app\\views\\helpers\\date.php', 'prettydate prettydate', '', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-a6f0-43aa-9cf9-077cc90e2450', 'ImageHelper', 'image-helper', 'D:\\wamp\\www\\cmscout\\app\\views\\helpers\\image.php', 'resize resize', 'cachedir cachedir', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-db70-41c9-82c4-077cc90e2450', 'showMenuHelper', 'show-menu-helper', 'D:\\wamp\\www\\cmscout\\app\\views\\helpers\\show_menu.php', 'menulist menulist', '', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-9ed8-481b-b9ae-077cc90e2450', 'TagcloudHelper', 'tagcloud-helper', 'D:\\wamp\\www\\cmscout\\app\\views\\helpers\\tagcloud.php', 'formulatetagcloud _getpercentsize __shuffletags formulatetagcloud _getpercentsize __shuffletags', '', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-328c-464b-abe7-077cc90e2450', 'tagcloud.php', 'tagcloud.php', 'D:\\wamp\\www\\cmscout\\app\\views\\helpers\\tagcloud.php', 'tagCloudcmp', NULL, 1, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26'),
('4a2cea9a-e678-4372-b23e-077cc90e2450', 'threadedHelper', 'threaded-helper', 'D:\\wamp\\www\\cmscout\\app\\views\\helpers\\threaded.php', 'show list_element show list_element', 'tab tab', 2, NULL, '2009-06-08 13:40:26', '2009-06-08 13:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `cms_aros`
--

CREATE TABLE IF NOT EXISTS `cms_aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aros_idx1` (`lft`,`rght`),
  KEY `aros_idx2` (`alias`),
  KEY `aros_idx3` (`model`,`foreign_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `cms_aros_acos`
--

CREATE TABLE IF NOT EXISTS `cms_aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL DEFAULT '0',
  `_read` char(2) NOT NULL DEFAULT '0',
  `_update` char(2) NOT NULL DEFAULT '0',
  `_delete` char(2) NOT NULL DEFAULT '0',
  `_admin` char(2) NOT NULL DEFAULT '0',
  `_reply` char(2) NOT NULL DEFAULT '0',
  `_moderate` char(2) NOT NULL DEFAULT '0',
  `_sticky` char(2) NOT NULL DEFAULT '0',
  `_announcement` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aroaco_idx` (`aro_id`,`aco_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `cms_aros_acos`
--

INSERT INTO `cms_aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`, `_admin`, `_reply`, `_moderate`, `_sticky`, `_announcement`) VALUES
(1, 2, 1, '0', '0', '0', '0', '1', '0', '0', '0', '0'),
(2, 2, 3, '0', '1', '1', '0', '0', '0', '0', '0', '0'),
(3, 2, 5, '1', '1', '0', '1', '0', '0', '0', '0', '0'),
(4, 2, 6, '1', '0', '1', '1', '0', '0', '0', '0', '0'),
(5, 2, 7, '1', '0', '1', '1', '0', '0', '0', '0', '0'),
(6, 2, 8, '0', '0', '1', '0', '0', '0', '0', '0', '0'),
(7, 2, 9, '0', '1', '1', '0', '0', '0', '0', '0', '0'),
(8, 2, 10, '0', '1', '1', '0', '0', '0', '0', '0', '0'),
(9, 7, 1, '0', '0', '0', '0', '1', '0', '0', '0', '0'),
(10, 7, 3, '0', '1', '1', '0', '0', '0', '0', '0', '0'),
(11, 7, 5, '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cms_cake_sessions`
--

CREATE TABLE IF NOT EXISTS `cms_cake_sessions` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_cake_sessions`
--

INSERT INTO `cms_cake_sessions` (`id`, `data`, `expires`) VALUES
('1jjerme630u2vihpmjuc7pb331', 'Config|a:3:{s:9:"userAgent";s:32:"27051bedf6236be7f5775ae119eee9b4";s:4:"time";i:1244188854;s:7:"timeout";i:10;}Auth|a:1:{s:4:"User";a:15:{s:2:"id";s:1:"1";s:8:"username";s:5:"admin";s:10:"first_name";s:5:"admin";s:9:"last_name";s:4:"user";s:13:"email_address";s:19:"admin@cmscout.co.za";s:6:"active";s:1:"1";s:7:"created";N;s:10:"last_login";N;s:6:"avatar";s:15:"irene-logo0.jpg";s:9:"signature";s:4:"Test";s:14:"public_profile";s:1:"1";s:9:"show_name";s:1:"1";s:10:"show_email";s:1:"0";s:7:"deleted";s:1:"0";s:12:"deleted_date";N;}}', 1244188857);

-- --------------------------------------------------------

--
-- Table structure for table `cms_comments`
--

CREATE TABLE IF NOT EXISTS `cms_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(500) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_id` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `foreign_id` (`model`,`foreign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_configuration`
--

CREATE TABLE IF NOT EXISTS `cms_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `category_name` varchar(300) NOT NULL,
  `input_type` varchar(50) NOT NULL,
  `options` varchar(500) NOT NULL,
  `label` varchar(300) NOT NULL,
  `order` int(11) NOT NULL,
  `auto_edit` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=29 ;

--
-- Dumping data for table `cms_configuration`
--

INSERT INTO `cms_configuration` (`id`, `name`, `value`, `category_name`, `input_type`, `options`, `label`, `order`, `auto_edit`) VALUES
(1, 'SiteName', 'CMScout3', 'Core', 'text', '', 'Website name', 1, 1),
(2, 'SiteEmail', 'webmaster@cmscout.co.za', 'Email', 'text', '', 'Website email address', 1, 1),
(3, 'Disabled', '0', 'Core', 'checkbox', '', 'Website disabled', 4, 1),
(4, 'Captcha', '1', 'Core', 'checkbox', '', 'Enable CAPTCHA image', 6, 1),
(5, 'DisableReason', 'This is a reason', 'Core', 'textarea', '', 'Reason for disabled website', 5, 1),
(6, 'AvatarSize', '100', 'Core', 'number', '', 'Longest side of an avatar', 7, 1),
(7, 'SiteTag', 'The easiest CMScout by far', 'Core', 'text', '', 'Website tag', 2, 1),
(11, 'EmailPrefix', '[CMScout3]', 'Email', 'text', '', 'Email Prefix', 2, 1),
(12, 'EnableEmails', '1', 'Email', 'checkbox', '', 'Enable Emails', 3, 1),
(13, 'SMTPHost', 'mail.wtfs.za.net', 'Email', 'text', '', 'SMTP Host/Server', 5, 1),
(14, 'SMTPPort', '25', 'Email', 'number', '', 'SMTP Port', 6, 1),
(15, 'SMTPUsername', 'wlalk@wtfs.za.net', 'Email', 'text', '', 'SMTP Username', 7, 1),
(16, 'SMTPPassword', 'jedirun43', 'Email', 'password', '', 'SMTP Password', 8, 1),
(17, 'AllowRegistration', '1', 'Registration', 'checkbox', '', 'Allow registration', 1, 1),
(18, 'DuplicateEmail', '1', 'Registration', 'checkbox', '', 'Duplicate email', 2, 1),
(19, 'AccountActivation', '1', 'Registration', 'select', 'No activation,User activation,Administrator activation', 'Account Activation', 3, 1),
(20, 'SMTP', '1', 'Email', 'checkbox', '', 'Use SMTP', 4, 1),
(21, 'PageTopics', '20', 'CMScout Forums', 'number', '', 'Number of topics per page', 1, 1),
(22, 'PagePosts', '20', 'CMScout Forums', 'number', '', 'Number of posts per page', 2, 1),
(23, 'InlineReply', '1', 'CMScout Forums', 'checkbox', '', 'Show quick reply box', 3, 1),
(24, 'editorType', '0', 'CMScout Forums', 'select', 'BBCode,Simple,Advanced,None', 'Type of editor', 4, 1),
(25, 'homePage', 'pages:pages:index', 'Core', '', '', '', 0, 0),
(26, 'themeId', '', 'Core', '', '', '', 0, 0),
(27, 'homePageOption', '', 'Core', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_contributions`
--

CREATE TABLE IF NOT EXISTS `cms_contributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `title` varchar(300) NOT NULL,
  `controller` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `plugin_id` (`plugin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_contributions`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_dashboards`
--

CREATE TABLE IF NOT EXISTS `cms_dashboards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `options` varchar(300) NOT NULL,
  `column` char(1) NOT NULL,
  `order` int(11) NOT NULL,
  `menu_link_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_link_id` (`menu_link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_dashboards`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_forums_categories`
--

CREATE TABLE IF NOT EXISTS `cms_forums_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(300) NOT NULL,
  `title` varchar(400) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_forums_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_forums_forums`
--

CREATE TABLE IF NOT EXISTS `cms_forums_forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(300) NOT NULL,
  `title` varchar(400) NOT NULL,
  `description` varchar(512) NOT NULL,
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `category` int(4) NOT NULL,
  `thread_count` int(11) NOT NULL,
  `post_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_category_id` (`category_id`),
  KEY `parent_id` (`parent_id`),
  KEY `lft` (`lft`),
  KEY `rght` (`rght`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_forums_forums`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_forums_posts`
--

CREATE TABLE IF NOT EXISTS `cms_forums_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(300) NOT NULL,
  `title` varchar(400) NOT NULL,
  `text` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `edit_reason` varchar(255) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `forum_thread_id` (`thread_id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_forums_posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_forums_subscribers`
--

CREATE TABLE IF NOT EXISTS `cms_forums_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `active` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `forum_thread_id` (`thread_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_forums_subscribers`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_forums_threads`
--

CREATE TABLE IF NOT EXISTS `cms_forums_threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(300) NOT NULL,
  `title` varchar(400) NOT NULL,
  `description` varchar(512) NOT NULL,
  `views` int(11) NOT NULL,
  `thread_type` int(2) NOT NULL DEFAULT '0',
  `locked` int(4) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `post_count` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_forums_threads`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_forums_unread_posts`
--

CREATE TABLE IF NOT EXISTS `cms_forums_unread_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `forum_thread_id` (`thread_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_forums_unread_posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_groups`
--

CREATE TABLE IF NOT EXISTS `cms_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) NOT NULL,
  `protected` char(1) NOT NULL DEFAULT '0',
  `members_protected` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_groups`
--

INSERT INTO `cms_groups` (`id`, `title`, `protected`, `members_protected`) VALUES
(1, 'Administrators', '1', ''),
(2, 'All users', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cms_groups_users`
--

CREATE TABLE IF NOT EXISTS `cms_groups_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cms_groups_users`
--

INSERT INTO `cms_groups_users` (`id`, `group_id`, `user_id`) VALUES
(1, 1, 1),
(4, 2, 1),
(5, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cms_menus`
--

CREATE TABLE IF NOT EXISTS `cms_menus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `plugin` varchar(200) DEFAULT NULL,
  `controller` varchar(200) NOT NULL,
  `action` varchar(200) NOT NULL,
  `edit_action` varchar(200) NOT NULL,
  `options` text NOT NULL,
  `sidebox` tinyint(1) NOT NULL,
  `menu_id` varchar(20) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_menus`
--

INSERT INTO `cms_menus` (`id`, `title`, `plugin`, `controller`, `action`, `edit_action`, `options`, `sidebox`, `menu_id`, `order`) VALUES
(1, 'Homepage', NULL, 'homepages', 'index', '', 'a:0:{}', 0, 'menu1', 1),
(2, 'Login', NULL, '', 'login', '', 'N;', 1, 'menu3', 1),
(3, 'User Control Panel', NULL, 'users', 'index', '', 'a:0:{}', 0, 'menu1', 2),
(4, 'Online Users', NULL, '', 'online', '', 'N;', 1, 'menu3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cms_menu_links`
--

CREATE TABLE IF NOT EXISTS `cms_menu_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `controller` varchar(300) NOT NULL,
  `action` varchar(300) NOT NULL,
  `menu_action` varchar(255) DEFAULT NULL,
  `homepage` tinyint(1) NOT NULL,
  `homepage_action` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plugin_id` (`plugin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cms_menu_links`
--

INSERT INTO `cms_menu_links` (`id`, `plugin_id`, `title`, `controller`, `action`, `menu_action`, `homepage`, `homepage_action`) VALUES
(3, NULL, 'Login', 'users', 'login', '', 0, ''),
(4, NULL, 'Logout', 'users', 'logout', '', 0, ''),
(5, NULL, 'User control panel', 'users', '', '', 0, ''),
(10, NULL, 'Homepage', 'homepages', 'index', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_notifications`
--

CREATE TABLE IF NOT EXISTS `cms_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) DEFAULT NULL,
  `name` varchar(300) NOT NULL,
  `type` varchar(300) NOT NULL,
  `title` varchar(300) NOT NULL,
  `subject` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `plugin_id` (`plugin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cms_notifications`
--

INSERT INTO `cms_notifications` (`id`, `plugin_id`, `name`, `type`, `title`, `subject`) VALUES
(1, NULL, 'new_user', 'email', 'New User', 'A new user has just registered'),
(2, NULL, 'registration_info', 'email', 'Registration information', 'Your registration'),
(3, NULL, 'user_status', 'email', 'User Status', 'Your account status has been changed'),
(4, 1, 'thread_reply', 'email', '', 'Reply notification'),
(5, 2, 'new_message', 'email', 'New private message', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_notifications_users`
--

CREATE TABLE IF NOT EXISTS `cms_notifications_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `notification_id` (`notification_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_notifications_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE IF NOT EXISTS `cms_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(300) NOT NULL,
  `title` varchar(400) NOT NULL,
  `text` longtext NOT NULL,
  `tags` mediumtext NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_pages`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_pages_tags`
--

CREATE TABLE IF NOT EXISTS `cms_pages_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_pages_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_plugins`
--

CREATE TABLE IF NOT EXISTS `cms_plugins` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `version` varchar(5) NOT NULL,
  `type` varchar(20) NOT NULL,
  `category` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_plugins`
--

INSERT INTO `cms_plugins` (`id`, `name`, `title`, `version`, `type`, `category`, `enabled`) VALUES
('5dd966c3-d345-11de-9f7f-25d5bd32c43f', 'Forums', 'CMScout Forums', '1.0', 'forum', 'Mini Application', 1),
('120541da-3683-4e47-b803-0a3000326b5c', 'Forums', 'CMScout Forums', '0.2', 'forum', 'Mini Application', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_plugin_actions`
--

CREATE TABLE IF NOT EXISTS `cms_plugin_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `link_label` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `plugin_id` (`plugin_id`),
  KEY `plugin_id_2` (`plugin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_plugin_actions`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_privatemessage_messages`
--

CREATE TABLE IF NOT EXISTS `cms_privatemessage_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `subject` varchar(400) NOT NULL,
  `message` longtext NOT NULL,
  `created` datetime DEFAULT NULL,
  `from_user_id` int(11) NOT NULL,
  `message_type` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from_user_id` (`from_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_privatemessage_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_privatemessage_messages_users`
--

CREATE TABLE IF NOT EXISTS `cms_privatemessage_messages_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `read` tinyint(1) NOT NULL,
  `new` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `pm_message_id` (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_privatemessage_messages_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_sideboxes`
--

CREATE TABLE IF NOT EXISTS `cms_sideboxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `element` varchar(300) NOT NULL,
  `model` varchar(255) NOT NULL,
  `plugin_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plugin_id` (`plugin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_sideboxes`
--

INSERT INTO `cms_sideboxes` (`id`, `title`, `element`, `model`, `plugin_id`) VALUES
(1, 'Login', 'loginBox', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tags`
--

CREATE TABLE IF NOT EXISTS `cms_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_themes`
--

CREATE TABLE IF NOT EXISTS `cms_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `directory` varchar(300) NOT NULL,
  `site_theme` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_themes`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_users`
--

CREATE TABLE IF NOT EXISTS `cms_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(300) NOT NULL,
  `last_name` varchar(300) NOT NULL,
  `email_address` varchar(350) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `signature` text NOT NULL,
  `public_profile` tinyint(1) NOT NULL DEFAULT '1',
  `show_name` tinyint(1) NOT NULL DEFAULT '1',
  `show_email` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL,
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_users`
--

INSERT INTO `cms_users` (`id`, `username`, `password`, `first_name`, `last_name`, `email_address`, `active`, `created`, `last_login`, `avatar`, `signature`, `public_profile`, `show_name`, `show_email`, `deleted`, `deleted_date`) VALUES
(1, 'admin', 'aa14740187e460cadfea631eea3d817c005d2757', 'admin', 'user', 'admin@cmscout.co.za', 1, NULL, NULL, 'irene-logo0.jpg', 'Test', 1, 1, 0, 0, NULL),
(2, 'dakota', 'aa14740187e460cadfea631eea3d817c005d2757', '', '', 'dakota@9thirene.co.za', 1, '2009-05-08 14:09:27', NULL, NULL, '', 1, 1, 0, 0, '2009-06-04 22:56:00'),
(3, 'bla', 'aa14740187e460cadfea631eea3d817c005d2757', '', '', 'sdf@dgs.com', 0, '2009-10-29 08:56:05', NULL, NULL, '', 1, 1, 0, 0, NULL);
