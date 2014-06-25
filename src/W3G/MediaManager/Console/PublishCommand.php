<?php

namespace W3G\MediaManager\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\AssetPublisher;


/**
 * Publish the MediaManager assets to the public directory
 *
 * @author Ahmad Azimi <a2azimi@gmail.com>
 */
class PublishCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'mediamanager:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the MediaManager assets to public folder';

    /**
     * The asset publisher instance.
     *
     * @var \Illuminate\Foundation\AssetPublisher
     */
    protected $assets;

    /**
     * Create a new Publish command
     *
     * @param \Illuminate\Foundation\AssetPublisher $assets
     */
    public function __construct(AssetPublisher $assets) {
        parent::__construct();

        $this->assets = $assets;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire() {
        $package = 'ahmadazimi/laravel-media-manager';
		
        if ( ! is_null($path = $this->getPath())) {
            $this->assets->publish($package, $path);
			
            $this->info('Assets published for package: '.$package);
        } else {
            $this->error('Could not find path for: '.$package);
        }
    }

    /**
     * Get the path of the assets folder. For now it's just vendor/ahmadazimi/laravel-media-manager/public,
     * but in the future could reference to a different composer package.
     */
    protected function getPath(){
        $path = with(new \ReflectionClass($this))->getFileName();
		
        return realpath(dirname($path).'/../../../../public');
    }


}
