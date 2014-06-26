<?php

/**
 * MediaManager configuration file.
 */

return array(
	
	'upload_dir' => 'media',
	
	'customData' => array() ,
	
	'customHeaders' => array() ,
	/*
	|----------------------------------------------------------------
	| AccessControl
	|----------------------------------------------------------------
	|
	| Function or class instance method to control files permissions.
	| 
	| https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options#wiki-accessControl
	|
	*/
	'accessControllCallback' => 'W3G\Elfinder\MediaManager::accessControll',
	/*
	|----------------------------------------------------------------
	| Roots
	|----------------------------------------------------------------
	| 
	| If you don't pass roots property, or pass null to it, the root
	| file will be LocalFileSystem with the above public upload_dir.
	| 
	| If you want custom options or advanced setup, you can set extra 
	| roots below:
	|
	| For more information see
	| https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options
	|
	*/
	'roots' => null,
);
