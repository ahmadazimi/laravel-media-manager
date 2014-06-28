<?php

return array(
	
	'dir' => 'media',

	'url' => null,

	'connectorAction' => null,

	'resizable' => false,

	'debug' => false,

	'requestType' => 'post',
	
	'customData' => array(
		'_token' => csrf_token()
	) ,
	
	'customHeaders' => array(
		'X-CSRF-Token' => csrf_token()
	) ,

	'accessControl' => 'W3G\MediaManager\MediaManager::accessControl',

	'roots' => null,
);
