<?php

declare(strict_types=1);

namespace MaciejKosiarski\MonologFactoryBundle\Service;

use Psr\Log\LoggerInterface;

class LoggerFactory
{
    protected $channels = [];

    public function addChannel($name, $loggerObject): void
    {
        $this->channels[$name] = $loggerObject;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function getLogger(string $channel): LoggerInterface
    {
        if (!array_key_exists($channel, $this->channels)) {
            throw new \InvalidArgumentException('You are trying to reach not defined logger channel');
        }

        return $this->channels[$channel];
    }
}