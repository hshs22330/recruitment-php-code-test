<?php

namespace App\Service;

interface iAppLogger
{
    public function info();
    public function debug();
    public function error();
}
class AppLogger implements iAppLogger
{
    private $logger;

    const TYPE_LOG4PHP = 'log4php';
    const TYPE_THINKLOG = 'think-log';

    public function __construct($type)
    {
        switch ($type) {
            case self::TYPE_THINKLOG:
                $this->logger = new ThinkLog();
                break;
            case self::TYPE_LOG4PHP:
            default:
              $this->logger =new Log4Php();

        }
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}

class Log4Php implements iAppLogger
{
    private $logger;
    public function __construct()
    {
        $this->logger = \Logger::getLogger("Log");
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}

class ThinkLog implements iAppLogger
{
    private $logger;
    public function __construct()
    {
        $this->logger = new \think\LogManager();
        $this->logger->init(
            [
                'default'	=>	'file',
                'channels'	=>	[
                    'file'	=>	[
                        'type'	=>	'file',
                        'path'	=>	'./logs/',
                    ],
                ],
            ]
        );
    }

    public function info($message = '')
    {
        $this->logger->info(mb_strtoupper($message));
    }

    public function debug($message = '')
    {
        $this->logger->debug(mb_strtoupper($message));
    }

    public function error($message = '')
    {
        $this->logger->error(mb_strtoupper($message));
    }
}