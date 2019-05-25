<?php
namespace XiaohuiLam\LaravelFilesystem\Wantu\Plugins;

use League\Flysystem\Plugin\AbstractPlugin;

class GetUrl extends AbstractPlugin
{
    public function getMethod()
    {
        return 'getUrl';
    }
    public function handle($path)
    {
        return $this->filesystem->getAdapter()->getUrl($path);
    }
}
