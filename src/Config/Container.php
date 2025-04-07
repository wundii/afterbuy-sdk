<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Config;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->defaults()
        ->public()
        ->autowire()
        ->autoconfigure()
    ;

    $services->load('Wundii\\AfterbuySdk\\Validator\\', __DIR__ . '/../Validator')
        ->public()
        ->autowire()
    ;
};
