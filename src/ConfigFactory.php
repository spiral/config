<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config;

use Spiral\Config\Exception\PatchDeliveredException;
use Spiral\Config\Exception\PatchException;
use Spiral\Core\ConfiguratorInterface;
use Spiral\Core\Container\SingletonInterface;

/**
 * Load config files, provides container injection and modifies config data on bootloading.
 */
class ConfigFactory implements ConfiguratorInterface, ModifierInterface, SingletonInterface
{
    /** @var LoaderInterface */
    private $loader;

    /** @var bool */
    private $strict;

    /** @var array */
    private $data = [];

    /** @var array */
    private $instances = [];

    /**
     * @param LoaderInterface $loader
     * @param bool            $strict
     */
    public function __construct(LoaderInterface $loader, bool $strict = true)
    {
        $this->loader = $loader;
        $this->strict = $strict;
    }

    /**
     * @inheritdoc
     */
    public function modify(string $section, PatchInterface $patch): array
    {
        if (isset($this->instances[$section])) {
            if ($this->strict) {
                throw new PatchDeliveredException(
                    "Unable to patch config `{$section}`, config object has already been delivered."
                );
            }

            unset($this->instances[$section]);
        }

        $data = $this->getConfig($section);

        try {
            return $this->data[$section] = $patch->patch($data);
        } catch (PatchException $e) {
            throw new PatchException("Unable to modify config `{$section}`.", $e->getCode(), $e);
        }
    }

    /**
     * @inheritdoc
     */
    public function getConfig(string $section = null): array
    {
        if (isset($this->data[$section])) {
            return $this->data[$section];
        }

        return $this->data[$section] = $this->loader->loadData($section);
    }

    /**
     * @inheritdoc
     */
    public function createInjection(\ReflectionClass $class, string $context = null)
    {
        $config = $class->getConstant('CONFIG');
        if (isset($this->instances[$config])) {
            return $this->instances[$config];
        }

        return $this->instances[$config] = $class->newInstance($this->getConfig($config));
    }

    /**
     * Clone state will reset both data and instance cache.
     */
    public function __clone()
    {
        $this->data = [];
        $this->instances = [];
    }
}