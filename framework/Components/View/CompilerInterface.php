<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 * @copyright ©2009-2015
 */
namespace Spiral\Components\View;

interface CompilerInterface
{
    public function __construct(
        ViewManager $viewManager,
        $namespace,
        $view,
        $source,
        $input = '',
        $output = ''
    );

    public function compile();
}