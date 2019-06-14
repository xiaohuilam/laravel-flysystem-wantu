<?php
namespace XiaohuiLam\LaravelFilesystem\Wantu\Plugins;

use League\Flysystem\Plugin\AbstractPlugin;

class UploadToken extends AbstractPlugin
{
    public function getMethod()
    {
        return 'getUploadToken';
    }

    public function handle($option = null)
    {
        return $this->filesystem->getAdapter()->getUploadToken($option);
    }
}
