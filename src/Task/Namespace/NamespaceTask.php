<?php

namespace Seworqs\Phing\String\Task\Namespace;

use Seworqs\Commons\String\Helper\NamespaceHelper;
use Seworqs\Phing\String\Task\Casing\AbstractCasingTask;

class NamespaceTask extends AbstractCasingTask
{
    protected function transform(string $input, array $options = []): string
    {
        return NamespaceHelper::fromString($input)->toNamespace($this->getSeparator());
    }

    public function getDefaultSuffix(): string
    {
        return 'namespace';
    }

    function applyOptions(array $options): void
    {
        parent::applyOptions($options);
    }
}
