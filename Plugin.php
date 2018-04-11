<?php namespace LukeTowers\GDriveFileSystemDriver;

use Storage;
use Google_Client;
use Google_Service_Drive;
use League\Flysystem\Filesystem;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;

use System\Classes\PluginBase;

/**
 * Google Drive File System Drive Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'luketowers.gdrivefilesystemdriver::lang.plugin.name',
            'description' => 'luketowers.gdrivefilesystemdriver::lang.plugin.description',
            'author'      => 'Luke Towers',
            'icon'        => 'icon-database',
            'homepage'    => 'https://github.com/LukeTowers/oc-gdrivefilesystemdriver-plugin',
        ];
    }

    /**
     * Runs right before the request route
     */
    public function boot()
    {
        Storage::extend('googledrive', function($app, $config) {
            $client = new Google_Client();
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);
            $service = new Google_Service_Drive($client);
            $adapter = new GoogleDriveAdapter($service, $config['folderId']);
            return new Filesystem($adapter);
        });
    }
}
