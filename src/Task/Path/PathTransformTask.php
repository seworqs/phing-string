<?php

namespace Seworqs\Phing\String\Task\Path;

use Phing\Exception\BuildException;
use Phing\Task;
use Seworqs\Commons\String\Helper\PathHelper;
use Seworqs\Phing\String\Task\Path\Operation\AppendPathOperation;
use Seworqs\Phing\String\Task\Path\Operation\PathOperationInterface;
use Seworqs\Phing\String\Task\Path\Operation\PrependPathOperation;
use Seworqs\Phing\String\Trait\CasingConfigTrait;

class PathTransformTask extends Task
{
    use CasingConfigTrait;

    protected ?string $from = null;
    protected ?string $value = null;
    protected ?string $property = null;
    protected ?string $suffix = null;
    protected bool $keepSubtaskProperties = false;

    /** @var PathOperationInterface[] */
    protected array $operations = [];

    public function setFrom(string $from): void { $this->from = $from; }
    public function setValue(string $value): void { $this->value = $value; }
    public function setProperty(string $property): void { $this->property = $property; }
    public function setSuffix(string $suffix): void { $this->suffix = $suffix; }
    public function setKeepSubtaskProperties(bool $keep): void { $this->keepSubtaskProperties = $keep; }

    public function main(): void
    {
        $input = $this->value ?? ($this->from ? $this->project->getProperty($this->from) : null);

        if ($input === null) {
            throw new BuildException("Either 'value' or 'from' must be specified and must exist.");
        }

        $path = $this->createHelper($input);

        foreach ($this->operations as $operation) {
            $path = $operation->apply($path);
        }

        $target = $this->property ?? ($this->from . '.' . $this->getSuffix());
        $this->project->setProperty($target, $path->toPath($this->separator ?? '/'));

        if ($this->keepSubtaskProperties) {
            $this->project->setProperty($this->from . '.' . $this->getDefaultSuffix(), $path->toPath($this->separator ?? '/'));
        }
    }

    protected function getSuffix(): string
    {
        return $this->suffix ?? $this->getDefaultSuffix();
    }

    protected function getDefaultSuffix(): string
    {
        return 'path';
    }

    protected function createHelper(string $input): PathHelper
    {
        return PathHelper::fromString($input, $this->getDelimiters());
    }

    public function addAppend(AppendPathOperation $op): void { $this->operations[] = $op; }
    public function addPrepend(PrependPathOperation $op): void { $this->operations[] = $op; }
}
