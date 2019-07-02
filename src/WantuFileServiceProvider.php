<?php

namespace XiaohuiLam\LaravelFilesystem\Wantu;

use League\Flysystem\Config;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use XiaohuiLam\LaravelFilesystem\Wantu\Plugins\GetUrl;
use XiaohuiLam\LaravelFilesystem\Wantu\Plugins\UploadToken;

class WantuFileServiceProvider extends ServiceProvider
{
    public function register()
    {
        app('filesystem')->extend('wantu', function ($app, $config) {
            $adapter = new WantuFileAdapter(
                $config['access_key'],
                $config['secret_key'],
                $config['namespace'],
                $config['domain']
            );
            $flysystem = new Filesystem($adapter, new Config(['disable_asserts' => true]));
            // $flysystem->addPlugin(new FetchFile());
            $flysystem->addPlugin(new UploadToken());
            $flysystem->addPlugin(new GetUrl());
            // $flysystem->addPlugin(new PrivateDownloadUrl());
            // $flysystem->addPlugin(new RefreshFile());
            return $flysystem;
        });
    }
}
