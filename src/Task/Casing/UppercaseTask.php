<?php

namespace Seworqs\Phing\String\Task\Casing;

use Seworqs\Commons\String\Enum\EnumCaseType;
use Seworqs\Commons\String\Helper\CaseHelper;

class UppercaseTask extends AbstractCasingTask
{
    protected function transform(string $value, array $options = []): string
    {
        return CaseHelper::from($value)->convertTo(EnumCaseType::UPPER);
    }

    public function getDefaultSuffix(): string
    {
        return 'uppercase';
    }

    public function applyOptions(array $options): void
    {
        // Uppercase does not use options, but we implement this for consistency
    }
}
