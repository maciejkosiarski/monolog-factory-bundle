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
        	$format = 'You are trying to reach not defined logger channel "%s", (defined: %s)';
            throw new \InvalidArgumentException(sprintf($format, $channel, implode(', ', $this->channels)));
        }

        return $this->channels[$channel];
    }
}