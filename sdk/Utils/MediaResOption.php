<?php

namespace AliMedia\Utils;

/**多媒体操作的输入输出资源信息。视频截图和视频转码都继承该类*/
abstract class MediaResOption
{
    private $input;                  //输入的资源
    private $output;                 //输出的资源
    /**设置输入的文件。*/
    public function setInputResource($namespace = null, $dir = null, $name = null)
    {
        $this->input = new ResourceInfo($namespace, $dir, $name);
    }
    /**设置输出的文件。*/
    public function setOutputResource($namespace = null, $dir = null, $name = null)
    {
        $this->output = new ResourceInfo($namespace, $dir, $name);
    }
    /**检测参数选项是否合法*/
    public function checkOptionParameters()
    {
        if (empty($this->input) || empty($this->output)) {
            return array(false, "input or output resources is empty."); // 判断是否设置输入输出文件，或者转码模板
        }
        list($valid, $msg) = $this->input->checkResourceInfo(true, true); //检测输入的资源信息是否合法
        if (!$valid) {
            return array($valid, $msg);
        }
        list($valid, $msg) = $this->output->checkResourceInfo(true, true); //检测输入的资源信息是否合法
        if (!$valid) {
            return array($valid, $msg);
        }
        return array(true, null);
    }
    public function getInputResId()
    {
        return $this->input->buildResourceId();
    }
    public function getOutputResId()
    {
        return $this->output->buildResourceId();
    }
    /**得到属性的http请求体*/
    abstract public function getOptionsHttpBody();
}
