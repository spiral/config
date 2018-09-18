<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Config\Loader;

use Spiral\Config\Exception\LoaderException;

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