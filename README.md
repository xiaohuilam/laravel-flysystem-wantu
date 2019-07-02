# Laravel 顽兔
Laravel 文件系统顽兔适配包。


## 版本适配
- ![php5.6+.svg](https://img.shields.io/badge/PHP-5.6+-4c1.svg)
- ![laravel5.2+.svg](https://img.shields.io/badge/Laravel-5.0+-4c1.svg)

## 单元测试
- [![build.svg](https://badges.herokuapp.com/travis/xiaohuilam/laravel-flysystem-wantu?branch=master&env=LARAVEL=%275.8.*%27&label=5.8)](https://travis-ci.org/xiaohuilam/laravel-flysystem-wantu)
- [![build.svg](https://badges.herokuapp.com/travis/xiaohuilam/laravel-flysystem-wantu?branch=master&env=LARAVEL=%275.7.*%27&label=5.7)](https://travis-ci.org/xiaohuilam/laravel-flysystem-wantu)
- [![build.svg](https://badges.herokuapp.com/travis/xiaohuilam/laravel-flysystem-wantu?branch=master&env=LARAVEL=%275.6.*%27&label=5.6)](https://travis-ci.org/xiaohuilam/laravel-flysystem-wantu)
- [![build.svg](https://badges.herokuapp.com/travis/xiaohuilam/laravel-flysystem-wantu?branch=master&env=LARAVEL=%275.5.*%27&label=5.5)](https://travis-ci.org/xiaohuilam/laravel-flysystem-wantu)
- [![build.svg](https://badges.herokuapp.com/travis/xiaohuilam/laravel-flysystem-wantu?branch=master&env=LARAVEL=%275.4.*%27&label=5.4)](https://travis-ci.org/xiaohuilam/laravel-flysystem-wantu)
- [![build.svg](https://badges.herokuapp.com/travis/xiaohuilam/laravel-flysystem-wantu?branch=master&env=LARAVEL=%275.3.*%27&label=5.3)](https://travis-ci.org/xiaohuilam/laravel-flysystem-wantu)
- [![build.svg](https://badges.herokuapp.com/travis/xiaohuilam/laravel-flysystem-wantu?branch=master&env=LARAVEL=%275.2.*%27&label=5.2)](https://travis-ci.org/xiaohuilam/laravel-flysystem-wantu)


## 安装

首先使用 composer 安装

```bash
composer require xiaohuilam/laravel-flysystem-wantu -vvv
```
如果你是 laravel 5.5 以下，请在 `config/app.php` 添加注册 ServiceProvider:
```php
<?php
return [
    'providers' => [
        //其他的provider，你需要在下面添加 ...
        \XiaohuiLam\LaravelFilesystem\Wantu\WantuFileServiceProvider::class,
    ],
];
```


## 授权
MIT
