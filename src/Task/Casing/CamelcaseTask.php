<?php

namespace Seworqs\Phing\String\Task\Casing;

use Seworqs\Commons\String\Enum\EnumCaseType;
use Seworqs\Commons\String\Helper\CaseHelper;
use Seworqs\Phing\String\Task\Interface\DelimiterAwareInterface;

class CamelcaseTask extends AbstractCasingTask implements DelimiterAwareInterface
{
    protected function transform(string $value): string
    {
        return CaseHelper::from($value)
            ->setDelimiters($this->getDelimiters())
            ->convertTo(EnumCaseType::CAMEL);
    }

    public function getDefaultSuffix(): string
    {
        return 'camelcase';
    }

    public function applyOptions(array $options): void
    {
        parent::applyOptions($options);
    }
}
