<?php
namespace AliMedia\Utils;

use AliMedia\Conf\Conf;

class UploadPolicy
{
    /*如下属性是必须的[The following attributes are required]*/
    public $namespace;                              // 多媒体服务的空间名[media namespace name]
    public $bucket;                                 // OSS的空间名[media bucket name]
    public $insertOnly;                             // 是否可覆盖[upload mode. it's not allowd uploading the same name files]
    public $expiration;                             // 过期时间[expiration time, unix time, in milliseconds]

    /*如下属性是可选的[The following attributes are optional]*/
    public $detectMime = Conf::DETECT_MIME_TRUE;                             // 是否进行类型检测[is auto detecte media file mime type, default is true]
    public $dir;                                    // 路径[media file dir, magic vars and custom vars are supported]
    public $name;                                   // 上传到服务端的文件名[media file name, magic vars and custom vars are supported]
    public $sizeLimit;                              // 文件大小限制[upload size limited, in bytes]
    public $mimeLimit;                              // 文件类型限制[upload mime type limited]
    public $callbackUrl;                            // 回调URL [callback urls, ip address is recommended]
    public $callbackHost;                           // 回调时Host [callback host]
    public $callbackBody;                           // 回调时Body [callback body, magic vars and custom vars are supported]
    public $callbackBodyType;                       // 回调时Body类型 [callback body type, default is 'application/x-www-form-urlencoded; charset=utf-8']
    public $returnUrl;                              // 上传完成之后,303跳转的Url [return url, when return code is 303]
    public $returnBody;                             // 上传完成返回体 [return body, magic vars and custom vars are supported]
    public $mediaEncode;                            // 上传音视频时，可以指定转码策略[media encode policy after upload task has been completed. it's json string]

    public function __construct($option)
    {
        if (!isset($option['expiration']) || !$option['expiration']) {
            $option['expiration'] = -1;
        }

        foreach ($option as $attribute => $value) {
            $this->{$attribute} = $value;
        }
    }

    public function toArray()
    {
        return (array) $this;
        $array = [];
        foreach ($this as $attribute => $value) {
            if ($value !== null) {
                $array[$attribute] = $value;
            }
        }

        return $array;
    }
}
