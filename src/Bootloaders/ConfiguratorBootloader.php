<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Configurator\Bootloaders;

use Spiral\Configurator\ConfigFactory;
use Spiral\Configurator\ModifierInterface;
use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Core\ConfiguratorInterface;

class ConfiguratorBootloader extends Bootloader
{
    const STRICT = true;

    const SINGLETONS = [
        ConfiguratorInterface::class => ConfigFactory::class,
        ModifierInterface::class     => ConfigFactory::class,
        ConfigFactory::class         => [self::class, 'makeFactory']
    ];

    /**
     * @return ConfigFactory
     */
    public function makeFactory(): ConfigFactory
    {
        // todo: get directory?

        return new ConfigFactory(null, static::STRICT);
    }
}