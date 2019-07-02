<?php

namespace AliMedia\Utils;

/**
 * 用于标识UploadOption对象的类型
 * @author yisheng.xp
 */
class UpOptionType
{
    //下面的常量用于标识UploadOption对象适用的类型
    const COMMON_UPLOAD_TYPE = 0;       //普通上传时的UploadOption类型
    const BLOCK_INIT_UPLOAD = 1;        //分片初始化时的UploadOption类型
    const BLOCK_RUN_UPLOAD = 2;         //分片上传过程中的UploadOption类型
    const BLOCK_COMPLETE_UPLOAD = 3;    //分片上传完成时的UploadOption类型
    const BLOCK_CANCEL_UPLOAD = 4;      //分片上传取消时的UploadOption类型
}
