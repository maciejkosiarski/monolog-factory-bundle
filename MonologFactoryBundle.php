<?php

declare(strict_types=1);

namespace MaciejKosiarski\MonologFactoryBundle;

use MaciejKosiarski\MonologFactoryBundle\DependencyInjection\Compiler\LoggerFactoryPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MonologFactoryBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new LoggerFactoryPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1);

        parent::build($container);
    }
}