<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Loader;

use Spiral\Config\Exception\InvalidArgumentException;
use Spiral\Config\Exception\LoaderException;
use Spiral\Config\LoaderInterface;
use Spiral\Core\FactoryInterface;

class DirectoryLoader implements LoaderInterface
{
    const LOADERS = [
        'php'  => PhpLoader::class,
        'json' => JsonLoader::class,
    ];

    /** @var string */
    private $directory;

    /** @var FactoryInterface */
    private $factory;

    /** @var DataLoaderInterface[] */
    private $loaders = [];

    /**
     * @param string           $directory
     * @param FactoryInterface $factory
     */
    public function __construct(string $directory, FactoryInterface $factory)
    {
        if (!is_dir($directory)) {
            throw new InvalidArgumentException("Invalid config directory `{$directory}`.");
        }

        $this->directory = rtrim($directory, '/');
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function loadData(string $section): array
    {
        foreach (static::LOADERS as $extension => $class) {
            $filename = sprintf("%s/%s.%s", $this->directory, $section, $extension);
            if (!file_exists($filename)) {
                continue;
            }

            try {
                return $this->getLoader($extension)->loadFile($section, $filename);
            } catch (LoaderException $e) {
                throw new LoaderException("Unable to load config `{$section}`.", $e->getCode(), $e);
            }
        }

        throw new LoaderException("Unable to load config `{$section}`.");
    }

    /**
     * @param string $extension
     * @return DataLoaderInterface
     */
    private function getLoader(string $extension): DataLoaderInterface
    {
        if (isset($this->loaders[$extension])) {
            return $this->loaders[$extension];
        }

        return $this->loaders[$extension] = $this->factory->make(static::LOADERS[$extension]);
    }
}