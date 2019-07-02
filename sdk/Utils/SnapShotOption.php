<?php

namespace AliMedia\Utils;

/**视频截图的参数*/
class SnapShotOption extends MediaResOption
{
    /** 视频截图的位置，单位为毫秒。该属性必须*/
    private $time;
    /** 通知url，任务结束之后会调用这个url。该属性可选 */
    private $notifyUrl;
    /**检测视频截图参数是否合法。如果合法，则返回http请求体<p> 返回格式{$isValid, $message, $httpBody}*/
    public function checkOptionParameters()
    {
        list($valid, $msg) = parent::checkOptionParameters(); //检测输入输出资源是否合法
        if (!$valid) {
            return array($valid, $msg, null);
        }
        if (empty($this->time) || !is_int($this->time) || $this->time < 0) {
            return array(false, "time is empty or invalid.", null); // 是否设置时间，且时间是否合法
        }
        return $this->getOptionsHttpBody(); //返回http请求体
    }

    /**构建多媒体转码所需的http请求体*/
    public function getOptionsHttpBody()
    {
        //必须的参数
        $httpBody = 'input=' . $this->getInputResId();
        $httpBody .= '&output=' . $this->getOutputResId();
        $httpBody .= '&time=' . $this->time;
        // 可选的参数
        if (isset($this->notifyUrl)) {
            $httpBody .= '&notifyUrl=' . urlencode($this->notifyUrl);
        }
        return array(true, "valid", $httpBody); //视频转码参数合法，返回http请求体
    }

    /**设置视频截图的位置，单位为毫秒。改参数必须设置*/
    public function setTime($time)
    {
        $this->time = $time;
    }
    /**设置截图完成后的通知url。可选*/
    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
    }
}
