<?php

namespace W3G\MediaManager;

class MediaManager {
	
	public static function accessControll($attr, $path, $data, $volume) {
		return strpos(basename($path) , '.') === 0 // if file/folder begins with '.' (dot)
		 ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
		 : null; // else elFinder decide it itself
	}
}
