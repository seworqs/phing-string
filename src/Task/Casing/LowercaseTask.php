<?php

namespace Seworqs\Phing\String\Task\Casing;

use Seworqs\Commons\String\Enum\EnumCaseType;
use Seworqs\Commons\String\Helper\CaseHelper;

class LowercaseTask extends AbstractCasingTask
{
    protected function transform(string $value, array $options = []): string
    {
        return CaseHelper::from($value)->convertTo(EnumCaseType::LOWER);
    }

    public function getDefaultSuffix(): string
    {
        return 'lowercase';
    }

    public function applyOptions(array $options): void
    {
        // Lowercase does not use options, but we implement this for consistency
    }
}
