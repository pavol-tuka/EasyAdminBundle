<?php

namespace EasyCorp\Bundle\EasyAdminBundle;

use EasyCorp\Bundle\EasyAdminBundle\DependencyInjection\CreateControllerRegistriesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 */
class EasyAdminBundle extends Bundle
{
    public const VERSION = '4.24.10-DEV';

    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new CreateControllerRegistriesPass());
    }

    public function getPath(): string
    {
        $reflected = new \ReflectionObject($this);
        /** @var non-empty-string $fileName */
        $fileName = $reflected->getFileName();

        return \dirname($fileName, 2);
    }
}
