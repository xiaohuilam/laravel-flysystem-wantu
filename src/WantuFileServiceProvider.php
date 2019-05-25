<?php

namespace XiaohuiLam\LaravelFilesystem\Wantu;

use Illuminate\Support\ServiceProvider;

class WantuFileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('filesystem')->extend('wantu', function ($app, $config) {
            $adapter = new WantuFileAdapter(
                $config['access_key'],
                $config['secret_key'],
                $config['namespace']//,
                //$config['domain']
            );
            $flysystem = new Filesystem($adapter, new Config(['disable_asserts' => true]));
            // $flysystem->addPlugin(new FetchFile());
            // $flysystem->addPlugin(new UploadToken());
            // $flysystem->addPlugin(new FileUrl());
            // $flysystem->addPlugin(new PrivateDownloadUrl());
            // $flysystem->addPlugin(new RefreshFile());
            return $flysystem;
        });
    }
}
