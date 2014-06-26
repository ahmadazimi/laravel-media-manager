<?php

namespace W3G\MediaManager;

use Config;
use View;

class MediaManagerController extends \BaseController {
	
	protected $package = 'laravel-media-manager';
	
	public function showStandalone() {
		$dir = $this->getPublicDirectory();
		
		$locale = $this->getLocale();
		
		return View::make($this->package . '::standalone')->with(compact('dir', 'locale'));
	}
	
	public function showTinyMCE() {
		$dir = $this->getPublicDirectory();
		
		$locale = $this->getLocale();
		
		return View::make($this->package . '::tinymce')->with(compact('path', 'locale'));
	}
	
	public function showTinyMCE4() {
		$dir = $this->getPublicDirectory();
		
		$locale = $this->getLocale();
		
		return View::make($this->package . '::tinymce4')->with(compact('dir', 'locale'));
	}
	
	public function showCKeditor4() {
		$dir = $this->getPublicDirectory();
		
		$locale = $this->getLocale();
		
		return View::make($this->package . '::ckeditor4')->with(compact('dir', 'locale'));
	}
	
	/**
	 * Setup connectors for elFinder class.
	 *
	 * @see https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options
	 */
	public function connector() {
		$locale = $this->getLocale();
		$roots = Config::get($this->package . '::roots');
		$upload_dir = Config::get($this->package . '::upload_dir');
		$accessControlCallback = Config::get($this->package . '::accessControllCallback');
		
		if (!$roots) {
			$root = array(
				'driver' => 'LocalFileSystem', // Driver for accessing file system (REQUIRED)
				'path' => public_path() . DIRECTORY_SEPARATOR . $upload_dir, // Path to upload directory (REQUIRED)
				'URL' => asset($upload_dir) , // URL to upload directory (REQUIRED)
				'accessControl' => $accessControlCallback, // Filter callback (OPTIONAL)
			);
			
			$roots[] = $root;
		}
		
		$opts = array(
			'roots' => $roots
		);
		
		$connector = new \elFinderConnector(new \elFinder($opts));
		$connector->run();
	}
	
	/**
	 * Get package public directory root path.
	 * 
	 */
	protected function getPublicDirectory() {
		return 'packages/ahmadazimi/' . $this->package;
	}
	
	/**
	 * Get application locale, only if the locale js file exists, otheriwse return false.
	 * 
	 */
	protected function getLocale() {
		$dir = $this->getPublicDirectory();
		
		$locale = Config::get('app.locale');
		
		if (!file_exists(public_path() . "/$dir/js/i18n/elfinder.$locale.js")) {
			$locale = false;
		}
		
		return $locale;
	}
}
