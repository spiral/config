<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Loaders;

use Spiral\Config\Exceptions\LoaderException;

class JsonLoader implements DataLoaderInterface
{
    /**
     * @inheritdoc
     */
    public function loadFile(string $section, string $filename): array
    {
        $content = file_get_contents($filename);
        $data = json_decode($content, true);

        if (is_null($data)) {
            throw new LoaderException(json_last_error_msg(), json_last_error());
        }

        return $data;
    }
}