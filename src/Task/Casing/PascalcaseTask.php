<?php

namespace Seworqs\Phing\String\Task\Casing;

use Seworqs\Commons\String\Enum\EnumCaseType;
use Seworqs\Commons\String\Helper\CaseHelper;
use Seworqs\Phing\String\Task\Interface\DelimiterAwareInterface;

class PascalcaseTask extends AbstractCasingTask implements DelimiterAwareInterface
{
    protected function transform(string $value): string
    {
        return CaseHelper::from($value)
            ->setDelimiters($this->getDelimiters())
            ->convertTo(EnumCaseType::PASCAL);
    }

    public function getDefaultSuffix(): string
    {
        return 'pascalcase';
    }

    public function applyOptions(array $options): void
    {
        parent::applyOptions($options);
    }
}
