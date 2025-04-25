<?php

namespace Seworqs\Phing\String\Task\Casing;

use Seworqs\Commons\String\Enum\EnumCaseType;
use Seworqs\Commons\String\Helper\CaseHelper;
use Seworqs\Phing\String\Task\Interface\DelimiterAwareInterface;

class ScreamingsnakecaseTask extends AbstractCasingTask implements DelimiterAwareInterface
{
    protected function transform(string $value, array $options = []): string
    {
        return CaseHelper::from($value)
            ->setDelimiters($options['delimiters'] ?? [])
            ->convertTo(EnumCaseType::SCREAMING_SNAKE);
    }

    public function getDefaultSuffix(): string
    {
        return 'screamingsnakecase';
    }

    public function applyOptions(array $options): void
    {
        parent::applyOptions($options);
    }
}
