<?php

namespace Seworqs\Phing\String\Task\Path;

use Seworqs\Commons\String\Helper\PathHelper;
use Seworqs\Phing\String\Task\Casing\AbstractCasingTask;

class PathTask extends AbstractCasingTask
{
    protected function transform(string $value, array $options = []): string
    {
        return PathHelper::fromString($value, $this->delimiters)->toCamelPath($this->getSeparator());
    }

    public function getDefaultSuffix(): string
    {
        return 'path';
    }

    function applyOptions(array $options): void
    {
        parent::applyOptions($options);
    }
}
