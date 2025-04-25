<?php

namespace Seworqs\Phing\String\Trait;

trait CasingConfigTrait
{
    protected array $delimiters = [' ', '-', '_', '/', '\\'];
    protected string $delimitersAsString = " ,-,_,/,\\"; // default

    protected string $delimiterSeparator = ',';
    protected bool $delimitersExplicitlySet = false;
    protected ?string $separator = null;
    protected bool $separatorExplicitlySet = false;

    public function setDelimiters(string $delimiters): void
    {
        $this->delimitersAsString = $delimiters;
        $this->delimitersExplicitlySet = true;
    }

    public function setDelimiterseparator(string $separator): void
    {
        $this->delimiterSeparator = $separator;
    }

    public function setSeparator(string $separator): void
    {
        $this->separator = $separator;
        $this->separatorExplicitlySet = true;
    }

    public function isDelimitersExplicitlySet(): bool
    {
        return $this->delimitersExplicitlySet;
    }

    public function isSeparatorExplicitlySet(): bool
    {
        return $this->separatorExplicitlySet;
    }

    public function applyOptions(array $options): void
    {
        // Respect earlier call (from parent like StringcaseTask)
        if ($this->optionsAlreadyApplied ?? false) {
            return;
        }

        $separator = $this->delimiterSeparator;

        if (isset($options['delimiterseparator']) && is_string($options['delimiterseparator'])) {
            $separator = $options['delimiterseparator'];
            $this->setDelimiterseparator($separator);
        }

        if ($this->delimitersExplicitlySet && isset($this->delimitersAsString)) {
            $this->delimiters = explode($separator, $this->delimitersAsString);
        }

        if (isset($options['separator']) && is_string($options['separator'])) {
            $this->setSeparator($options['separator']);
        }

        if (isset($options['suffix']) && is_string($options['suffix'])) {
            $this->setSuffix($options['suffix']);
        }

        if (isset($options['from']) && is_string($options['from'])) {
            $this->setFrom($options['from']);
        }

        if (isset($options['value']) && is_string($options['value'])) {
            $this->setValue($options['value']);
        }

        if (isset($options['property']) && is_string($options['property'])) {
            $this->setProperty($options['property']);
        }

        $this->optionsAlreadyApplied = true;
    }

    public function getDelimiters(): array
    {
        return $this->delimiters;
    }

    public function getDelimiterSeparator(): string
    {
        return $this->delimiterSeparator;
    }

    public function getSeparator(): string
    {
        return $this->separator ?? '/';
    }
}
