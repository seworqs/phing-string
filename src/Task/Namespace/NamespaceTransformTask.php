<?php

namespace Seworqs\Phing\String\Task\Namespace;

use Seworqs\Commons\String\Helper\NamespaceHelper;
use Seworqs\Commons\String\Helper\PathHelper;
use Seworqs\Phing\String\Task\Path\PathTransformTask;

class NamespaceTransformTask extends PathTransformTask
{
    protected ?string $separator = '\\';

    public function setSeparator(string $separator): void
    {
        $this->separator = $separator;
        $this->separatorExplicitlySet = true;
    }

    protected function createHelper(string $input): PathHelper
    {
        return NamespaceHelper::fromString($input, $this->getDelimiters());
    }

    protected function getDefaultSuffix(): string
    {
        return 'namespace';
    }

    public function main(): void
    {
        if ($this->from === null) {
            throw new \Phing\Exception\BuildException("Attribute 'from' is required.");
        }

        $value = $this->project->getProperty($this->from);
        if ($value === null) {
            throw new \Phing\Exception\BuildException("Property '{$this->from}' does not exist");
        }

        $ns = $this->createHelper($value);

        foreach ($this->operations as $operation) {
            $ns = $operation->apply($ns);
        }

        $target = $this->property ?? ($this->from . '.' . ($this->suffix ?? $this->getDefaultSuffix()));
        $this->project->setProperty($target, $ns->toNamespace($this->separator ?? '\\'));

        if ($this->keepSubtaskProperties) {
            $this->project->setProperty($this->from . '.' . $this->getDefaultSuffix(), $ns->toNamespace($this->separator ?? '\\'));
        }
    }
}
