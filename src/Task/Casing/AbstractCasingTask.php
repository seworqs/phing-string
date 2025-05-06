<?php

namespace Seworqs\Phing\String\Task\Casing;

use Phing\Exception\BuildException;
use Phing\Task;
use Seworqs\Phing\String\Trait\CasingConfigTrait;

abstract class AbstractCasingTask extends Task
{
    use CasingConfigTrait {
        setDelimiters as protected traitSetDelimiters;
        applyOptions as protected traitApplyOptions;
    }

    protected ?string $value = null;
    protected ?string $from = null;
    protected ?string $property = null;
    protected ?string $suffix = null;

    protected string $delimitersAsString = " ,-,_,/,\\"; // default delimiter string

    protected bool $optionsAlreadyApplied = false;

    public function setValue(string $value): void { $this->value = $value; }
    public function setFrom(string $from): void { $this->from = $from; }
    public function setProperty(string $property): void { $this->property = $property; }
    public function setSuffix(string $suffix): void { $this->suffix = ltrim($suffix, '.'); }

    public function setDelimiters(string $delimiters): void {
        $this->delimitersAsString = $delimiters;
        $this->traitSetDelimiters($delimiters);
    }

    abstract protected function transform(string $value): string;
    abstract public function getDefaultSuffix(): string;

    public function getSuffix(): string {
        return $this->suffix ?? $this->getDefaultSuffix();
    }

    public function hasSuffix(): bool { return $this->suffix !== null; }
    public function hasFrom(): bool { return $this->from !== null; }
    public function hasValue(): bool { return $this->value !== null; }
    public function hasProperty(): bool { return $this->property !== null; }

    public function main(): void
    {
        if (!$this->optionsAlreadyApplied) {
            $this->applyOptions($this->buildOptions());
        }

        $output = $this->transform($this->resolveInput());
        $this->project->setProperty($this->resolveTargetProperty(), $output);
    }

    protected function resolveInput(): string
    {
        if ($this->value !== null) return $this->value;
        if ($this->from !== null) {
            $input = $this->project->getProperty($this->from);
            if ($input === null) throw new BuildException("Property '{$this->from}' does not exist");
            return $input;
        }
        throw new BuildException("Either 'value' or 'from' must be specified");
    }

    protected function resolveTargetProperty(): string
    {
        if ($this->property !== null) return $this->property;
        if ($this->from !== null) return $this->from . '.' . ($this->suffix ?? $this->getDefaultSuffix());
        throw new BuildException("Either 'property' or 'from' must be specified");
    }

    protected function buildOptions(): array
    {
        return [
            'delimiters' => $this->delimiters,
            'delimiterseparator' => $this->delimiterSeparator,
            'from' => $this->from,
            'value' => $this->value,
            'property' => $this->property,
            'suffix' => $this->suffix,
        ];
    }

    public function applyOptions(array $options): void
    {
        if ($this->optionsAlreadyApplied) return;

        $this->traitApplyOptions($options);

        foreach ($options as $key => $value) {
            match ($key) {
                'suffix' => is_string($value) ? $this->setSuffix($value) : null,
                'from' => is_string($value) ? $this->setFrom($value) : null,
                'property' => is_string($value) ? $this->setProperty($value) : null,
                'value' => is_string($value) ? $this->setValue($value) : null,
                default => null,
            };
        }

        $this->optionsAlreadyApplied = true;
    }
}
