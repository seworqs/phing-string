<?php

namespace Seworqs\Phing\String\Task\Random;

use Phing\Exception\BuildException;
use Phing\Task;
use Seworqs\Commons\String\Helper\RandomHelper;

class RandomStringTask extends Task
{
    protected ?string $property = null;
    protected int $length = 10;
    protected ?string $haystack = null;

    public function setProperty(string $property): void
    {
        $this->property = $property;
    }

    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    public function setHaystack(string $haystack): void
    {
        $this->haystack = $haystack;
    }

    public function main(): void
    {
        if ($this->property === null) {
            throw new BuildException("Attribute 'property' is required.");
        }

        $value = $this->haystack !== null
            ? RandomHelper::createRandomString($this->length, $this->haystack)
            : RandomHelper::createRandomString($this->length);

        $this->project->setProperty($this->property, $value);
    }
}
