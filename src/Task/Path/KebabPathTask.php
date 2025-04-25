<?php

namespace Seworqs\Phing\String\Task\Path;

use Seworqs\Commons\String\Helper\PathHelper;
use Seworqs\Phing\String\Task\Casing\AbstractCasingTask;

class KebabPathTask extends PathTask
{
    protected function transform(string $value, array $options = []): string
    {
        return PathHelper::fromString($value, $this->delimiters)->toKebabPath($this->getSeparator());
    }

    public function getDefaultSuffix(): string
    {
        return 'kebabpath';
    }
}
