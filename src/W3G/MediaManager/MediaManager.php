<?php
namespace W3G\MediaManager;

use \Config;

class MediaManager {
	
	public static $package = 'laravel-media-manager';
	
	private static $clientConfigNames = array(
		'url',
		'debug',
		'resizable',
		'customData',
		'customHeaders',
		'requestType',
		'cookie',
		'sync',
		'iframeTimeout',
		'urlUpload',
		'showThreshold',
		'showFiles',
		'loadTmbs',
		'allowShortcuts',
		'dragUploadAllow',
		'notifyDelay',
		'contextmenu',
		'uiOptions',
		'ui',
		'handlers',
		'getFileCallback',
		'commandsOptions',
		'commands',
		'fancyDateFormat',
		'dateFormat',
		'UTCDate',
		'clientFormatDate',
		'height',
		'width',
		'sortDirect',
		'sort',
		'defaultView',
		'validName',
		'onlyMimes',
		'useBrowserHistory',
		'rememberLastDir',
		'cssClass',
	);
	
	private static $connectorConfigNames = array(
		'dir',
		'roots',
		'locale',
		'bind',
		'debug',
		'accessControl',
	);
	
	public static function accessControl($attr, $path, $data, $volume) {
		return strpos(basename($path) , '.') === 0 // if file/folder begins with '.' (dot)
		 ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
		 : null; // else elFinder decide it itself
	}
	
	public static function getConfig($key) {
		$pkg = self::$package;
		
		if (!is_string($key)) {
			return null;
		}

		return Config::get("{$pkg}::{$key}");
	}
	
	public static function getClientsideConfig() {
		$config = array();

		$pkg = self::$package;

		$locale = Config::get('app.locale');
		$locale_file = public_path() . "/packages/ahmadazimi/{$pkg}/js/i18n/elfinder.{$locale}.js";
		$connector_action = self::getConfig('connectorAction');
		
		foreach (self::$clientConfigNames as $key) {
			$value = Config::get("{$pkg}::{$key}");
			
			!is_null($value) && $config[$key] = $value;
		}
		
		file_exists($locale_file) && $config['lang'] = $locale;
		
		if(!isset($config['debug']) || is_null($config['debug'])) {
			$config['debug'] = Config::get('app.debug');
		}

		if(!isset($config['url']) || !$config['url']) {
			$config['url'] = \URL::action($connector_action || 'W3G\MediaManager\MediaManagerController@connector');
		}

		return $config;
	}

	public static function getConnectorConfig() {
		$config = array();

		$pkg = self::$package;
		
		foreach (self::$connectorConfigNames as $key) {
			$value = Config::get("{$pkg}::{$key}");
			
			!is_null($value) && $config[$key] = $value;
		}

		if(!isset($config['debug']) || is_null($config['debug'])) {
			$config['debug'] = Config::get('app.debug');
		}

		if(!isset($config['roots'])) {
			$upload_dir = array_pull($config, 'dir');
			$path = public_path() . DIRECTORY_SEPARATOR . $upload_dir;
			$url = asset($upload_dir);

			$root = array(
				'driver' => 'LocalFileSystem',
				'path' => $path,
				'URL' => $url
			);

			if(isset($config['accessControl'])) {
				$root['accessControl'] = array_pull($config, 'accessControl');
			}

			$config['roots'] = array($root);
		}

		return $config;
	}
}
