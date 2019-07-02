<?php
namespace EasyTask;

class Process
{
    /**
     * @var bool 是否守护进程
     */
    private $daemon = false;

    /**
     * @var int 子进程休息时间
     */
    private $sleepTime = 1;

    /**
     * @var bool 关闭标准输入输出
     */
    private $closeInOut = false;

    /**
     * @var bool 支持异步信号
     */
    private $canAsync = false;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->canAsync = function_exists('pcntl_async_signals');
        if ($this->canAsync)
        {
            $this->sleepTime = 100;
            pcntl_async_signals(true);
        }
    }

    /**
     * 设置守护
     * @param bool $daemon 是否守护
     */
    public function setDaemon($daemon = false)
    {
        $this->daemon = $daemon;
    }

    /**
     * 设置标准输入输出
     * @param bool $closeInOut
     */
    public function setInOut($closeInOut = false)
    {
        $this->closeInOut = $closeInOut;
    }
}