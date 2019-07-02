<?php

namespace AliMedia\Utils;

/**多媒体转码的参数*/
class MediaEncodeOption extends MediaResOption
{
    /* 以下属性是"视频转码"方法必须的属性 */
    private $encodeTemplate;          //模板名称。可以设置系统或者用户自定义模板。用户模板名称可以登录后台查看和设置，系统模板见附录系统模板列表
    public $usePreset = 0;            //是否使用系统模板。默认0。如果为1，则encodeTemplate必须设置系统模板名称
    public $force = 0;                //是否强制覆盖。默认0，如果为1，当output文件已经存在的时候会强制覆盖，否则不执行转码并结束任务
    /* 以下属性是"视频转码"方法可选的属性 */
    private $watermark;               //水印资源
    private $watermarkTemplate;       //用户自定义水印模板
    private $notifyUrl;               //通知url，任务结束之后会调用这个url
    private $seek;                    //截取音视频的开始位置
    private $duration;                //截取音视频的长度

    /**设置转码模板。必须。模板在顽兔控制台"多媒体处理"中配置*/
    public function setEncodeTemplate($encodeTemplate)
    {
        $this->encodeTemplate = $encodeTemplate;
    }
    /**检测多媒体转码选项是否合法。如果合法，则返回http请求体<p> 返回格式{$isValid, $message, $httpBody}*/
    public function checkOptionParameters()
    {
        list($valid, $msg) = parent::checkOptionParameters(); //检测输入输出资源是否合法
        if (!$valid) {
            return array($valid, $msg, null);
        }
        if (empty($this->encodeTemplate)) {
            return array(false, "encodeTemplate is empty.", null); // 判断是否设置输入输出文件，或者转码模板
        }
        if (($this->usePreset != 0 && $this->usePreset != 1) || ($this->force != 0 && $this->force != 1)) {
            return array(false, "parameters 'usePreset' or 'force' is invalid.", null); // 判断usePreset和force参数是否为0或1
        }
        return $this->getOptionsHttpBody(); //返回http请求体
    }
    /**构建多媒体转码所需的http请求体*/
    public function getOptionsHttpBody()
    {
        //必须的参数
        $httpBody = 'input=' . $this->getInputResId();
        $httpBody .= '&output=' . $this->getOutputResId();
        $httpBody .= '&encodeTemplate=' . urlencode($this->encodeTemplate);
        $httpBody .= '&usePreset=' . $this->usePreset;
        $httpBody .= '&force=' . $this->force;
        // 可选的参数
        if (isset($this->watermark)) {
            $httpBody .= '&watermark=' . $this->watermark->buildResourceId();
        }
        if (isset($this->watermarkTemplate)) {
            $httpBody .= '&watermarkTemplate=' . urlencode($this->watermarkTemplate);
        }
        if (isset($this->notifyUrl)) {
            $httpBody .= '&notifyUrl=' . urlencode($this->notifyUrl);
        }
        if (isset($this->seek)) {
            $httpBody .= '&seek=' .  $this->seek;
        }
        if (isset($this->duration)) {
            $httpBody .= '&duration=' . $this->duration;
        }
        return array(true, "valid", $httpBody); //视频转码参数合法，返回http请求体
    }
    /*######################以下是可选的参数set方法#######################*/
    /**设置水印。可选*/
    public function setWatermark($namespace = null, $dir = null, $name = null)
    {
        $this->watermark = new ResourceInfo($namespace, $dir, $name);
    }
    /**设置用户自定义水印模板。可选*/
    public function setWatermarkTemplate($watermarkTemplate)
    {
        $this->watermarkTemplate = $watermarkTemplate;
    }
    /**设置转码完成后的通知url。可选*/
    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
    }
    /**设置转码起始位置。可选*/
    public function setSeek($seek)
    {
        $this->seek = $seek;
    }
    /**设置转码长度。可选*/
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }
}
