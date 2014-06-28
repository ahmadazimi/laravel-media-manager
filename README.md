Laravel Media Manager 0.1.0 beta
=====================

### This package is still under development.

Laravel 4 advanced media manager (file manager and uploader) package based on [elFinder 2.1](https://github.com/Studio-42/elFinder/tree/2.1). Inspired by [laravel-elfinder](https://github.com/barryvdh/laravel-elfinder) package developed by [Barry vd. Heuvel](https://github.com/barryvdh).
Note that this package is still under development. You can use this file manager in Laravel 4 as a standalone media manager or as a plugin for TinyMCE or CKEditor. For more info take a look at files in `src/views` folder.

### Installation

First of all you should add laravel-media-manager package to your composer.json file using this line:

    "ahmadazimi/laravel-media-manager": "dev-master",

	
Add the MediaManagerServiceProvider to your application providers by adding this line to providers array in app/config/app.php:

    'W3G\MediaManager\MediaManagerServiceProvider',

To copy the Media Manager assets to the public folder, using the following artisan command:

    php artisan mediamanager:publish
	
Also remember to publish the assets after each update (or add the command to your post-update-cmd in composer.json)

You can now add the routes for elFinder to your routes.php

    Route::group(array('before' => 'auth'), function()
        {
            \Route::get('media', 'W3G\MediaManager\MediaManagerController@showStandalone');
            \Route::any('media/connector', 'W3G\MediaManager\MediaManagerController@connector');
        });

Of course you can define your own filters/routes if you want.
	
### Configuration

The default configuration requires a directory called 'media' in the public folder. You can change this by publishing the config file.

    php artisan config:publish ahmadazimi/laravel-media-manager

In your app/config/packages/ahmadazimi/laravel-media-manager, you can change the default folder, the access callback or define your own roots and also some extra parameters for elFinder.






