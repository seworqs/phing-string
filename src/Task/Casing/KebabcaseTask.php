<?php

namespace Seworqs\Phing\String\Task\Casing;

use Seworqs\Commons\String\Enum\EnumCaseType;
use Seworqs\Commons\String\Helper\CaseHelper;
use Seworqs\Phing\String\Task\Interface\DelimiterAwareInterface;

class KebabcaseTask extends AbstractCasingTask implements DelimiterAwareInterface
{
    protected function transform(string $value, array $options = []): string
    {
        return CaseHelper::from($value)
            ->setDelimiters($this->delimiters)
            ->convertTo(EnumCaseType::KEBAB);
    }

    public function getDefaultSuffix(): string
    {
        return 'kebabcase';
    }

    public function applyOptions(array $options): void
    {
        parent::applyOptions($options);
    }
}
