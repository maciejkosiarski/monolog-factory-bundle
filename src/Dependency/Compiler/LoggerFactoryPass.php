<?php

declare(strict_types=1);

namespace MaciejKosiarski\MonologFactoryBundle\Dependency\Compiler;

use MaciejKosiarski\MonologFactoryBundle\Service\LoggerFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class LoggerFactoryPass implements  CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\InvalidArgumentException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(LoggerFactory::class) || !$container->hasDefinition('monolog.logger')) {
            return;
        }

        $definition = $container->findDefinition(LoggerFactory::class);
        foreach ($container->getParameter('monolog.additional_channels') as $channel) {
            $loggerId = sprintf('monolog.logger.%s', $channel);
            $definition->addMethodCall('addChannel', [
                $channel,
                new Reference($loggerId)
            ]);
        }
    }
}