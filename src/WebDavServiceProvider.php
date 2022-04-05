<?php
namespace SingleQuote\WebDav;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use League\Flysystem\WebDAV\WebDAVAdapter;
use Sabre\DAV\Client as WebDAVClient;

class WebDavServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Storage::extend('webdav', function ($app, $config) {
            $pathPrefix = array_key_exists('pathPrefix', $config) ? $config['pathPrefix'] : null;

            $client = new WebDAVClient($config);

            $adapter = new WebDAVAdapter($client, $pathPrefix);

            return new Filesystem($adapter);
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        
    }
}
