<?php

namespace Seworqs\Phing\String\Task\Path;

use Seworqs\Commons\String\Helper\PathHelper;
use Seworqs\Phing\String\Task\Casing\AbstractCasingTask;

class SnakePathTask extends PathTask
{
    protected function transform(string $input, array $options = []): string
    {
        return PathHelper::fromString($input)->toSnakePath($this->getSeparator());
    }

    public function getDefaultSuffix(): string
    {
        return 'snakepath';
    }
}
