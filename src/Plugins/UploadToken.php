<?php

namespace XiaohuiLam\LaravelFilesystem\Wantu\Plugins;

use League\Flysystem\Plugin\AbstractPlugin;

class UploadToken extends AbstractPlugin
{
    public function getMethod()
    {
        return 'getUploadToken';
    }

    public function handle($key = null, $expires = 3600, $policy = null, $strictPolice = null)
    {
        return $this->filesystem->getAdapter()->getUploadToken($key, $expires, $policy, $strictPolice);
    }
}
