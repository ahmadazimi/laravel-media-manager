<?php

namespace W3G\MediaManager;

use Config;
use View;

class MediaManagerController extends \BaseController {
	
	protected $package = 'laravel-media-manager';
	
	public function showStandalone() {
		$config = MediaManager::getClientsideConfig();

		$package_url = asset("/packages/ahmadazimi/" . $this -> package);
		
		return View::make($this->package . '::standalone')->with(compact('package_url', 'config'));
	}
	
	public function showTinyMCE() {
		$config = MediaManager::getClientsideConfig();

		$package_url = asset("/packages/ahmadazimi/" . $this -> package);
		
		return View::make($this->package . '::tinymce')->with(compact('package_url', 'config'));
	}
	
	public function showTinyMCE4() {
		$config = MediaManager::getClientsideConfig();

		$package_url = asset("/packages/ahmadazimi/" . $this -> package);
		
		return View::make($this->package . '::tinymce4')->with(compact('package_url', 'config'));
	}
	
	public function showCKeditor4() {
		$config = MediaManager::getClientsideConfig();

		$package_url = asset("/packages/ahmadazimi/" . $this -> package);
		
		return View::make($this->package . '::ckeditor4')->with(compact('package_url', 'config'));
	}
	
	/**
	 * Setup connectors for elFinder class.
	 *
	 * @see https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options
	 */
	public function connector() {
		$config = MediaManager::getConnectorConfig();

		$connector = new \elFinderConnector(new \elFinder($config));
		$connector->run();
	}
}
