<?php
namespace XiaohuiLam\LaravelFilesystem\Test;

use XiaohuiLam\LaravelFilesystem\Test\AbstractTest\AbstractTest;
use Illuminate\Support\Facades\Storage;
use XiaohuiLam\LaravelFilesystem\Wantu\WantuFileAdapter;

class FilesystemTest extends AbstractTest
{
    /**
     * 测试登陆
     *
     * @return void
     */
    public function testRegisterProvider()
    {
        /**
         * @var \Illuminate\Filesystem\FilesystemAdapter $disk
         */
        $disk = Storage::disk('wantu');
        $this->assertEquals(WantuFileAdapter::class, get_class($disk->getDriver()->getAdapter()));
    }
}
