<?php

namespace Seworqs\Phing\String\Task\Casing;

use Phing\Exception\BuildException;
use Phing\Task;
use Seworqs\Phing\String\Task\Interface\DelimiterAwareInterface;
use Seworqs\Phing\String\Trait\CasingConfigTrait;

/**
 * Executes one or more casing operations in sequence (chained),
 * while optionally storing each intermediate result separately.
 */
class StringcaseTask extends Task
{
    use CasingConfigTrait;

    protected ?string $from = null;
    protected ?string $property = null;
    protected ?string $suffix = null;
    protected bool $keepSubtaskProperties = false;

    /** @var AbstractCasingTask[] */
    protected array $operations = [];

    public function setFrom(string $from): void { $this->from = $from; }
    public function setProperty(string $property): void { $this->property = $property; }
    public function setSuffix(string $suffix): void { $this->suffix = ltrim($suffix, '.'); }
    public function setKeepsubtaskproperties(bool $keep): void { $this->keepSubtaskProperties = $keep; }

    // Task registration (Phing calls these)
    public function addUppercase(UppercaseTask $task): void { $this->operations[] = $task; }
    public function addLowercase(LowercaseTask $task): void { $this->operations[] = $task; }
    public function addPascalcase(PascalcaseTask $task): void { $this->operations[] = $task; }
    public function addCamelcase(CamelcaseTask $task): void { $this->operations[] = $task; }
    public function addSnakecase(SnakecaseTask $task): void { $this->operations[] = $task; }
    public function addScreamingsnakecase(ScreamingsnakecaseTask $task): void { $this->operations[] = $task; }
    public function addKebabcase(KebabcaseTask $task): void { $this->operations[] = $task; }
    public function addScreamingkebabcase(ScreamingkebabcaseTask $task): void { $this->operations[] = $task; }
    public function addTitlecase(TitlecaseTask $task): void { $this->operations[] = $task; }

    public function main(): void
    {
        if ($this->from === null) {
            throw new BuildException("Attribute 'from' is required.");
        }

        $original = $this->project->getProperty($this->from);
        if ($original === null) {
            throw new BuildException("Property '{$this->from}' does not exist");
        }

        $chainedValue = $original;
        $isChained = $this->property !== null || $this->suffix !== null;
        $sharedOptions = $this->buildOptions();

        foreach ($this->operations as $task) {
            $task->setProject($this->project);
            $task->setFrom($this->from);

            if (
                $task instanceof DelimiterAwareInterface &&
                !$task->isDelimitersExplicitlySet()
            ) {
                $task->applyOptions($sharedOptions);
            }

            if ($this->keepSubtaskProperties || $task->hasSuffix() || $task->hasProperty()) {
                $task->setValue($original);

                if (!$task->hasProperty()) {
                    $task->setProperty($this->from . '.' . $task->getSuffix());
                }

                $task->main();
            }

            if ($isChained) {
                $task->setValue($chainedValue);
                $task->setProperty('__stringcase.intermediate');
                $task->main();
                $chainedValue = $this->project->getProperty('__stringcase.intermediate');
            }
        }

        if ($isChained) {
            $target = $this->property ?? ($this->from . '.' . ltrim($this->suffix, '.'));
            $this->project->setProperty($target, $chainedValue);
            $this->project->setProperty('__stringcase.intermediate', null); // cleanup
        }
    }

    protected function buildOptions(): array
    {
        return array_filter([
            'delimiters' => $this->getDelimiters(),
            'delimiterseparator' => $this->getDelimiterSeparator(),
            'separator' => $this->getSeparator(),
        ]);
    }
}
