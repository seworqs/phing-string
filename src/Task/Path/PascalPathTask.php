<?php

namespace Seworqs\Phing\String\Task\Path;

use Seworqs\Commons\String\Helper\PathHelper;
use Seworqs\Phing\String\Task\Casing\AbstractCasingTask;

class PascalPathTask extends PathTask
{
    protected function transform(string $input, array $options = []): string
    {
        return PathHelper::fromString($input)->toPascalPath($this->getSeparator());
    }

    public function getDefaultSuffix(): string
    {
        return 'snakepath';
    }
}
