<?php

namespace Seworqs\Phing\String\Task\Casing;

use Seworqs\Commons\String\Enum\EnumCaseType;
use Seworqs\Commons\String\Helper\CaseHelper;
use Seworqs\Phing\String\Task\Interface\DelimiterAwareInterface;

class TitlecaseTask extends AbstractCasingTask implements DelimiterAwareInterface
{
    protected function transform(string $value, array $options = []): string
    {
        return CaseHelper::from($value)
            ->setDelimiters($this->getDelimiters())
            ->convertTo(EnumCaseType::TITLE);
    }

    public function getDefaultSuffix(): string
    {
        return 'titlecase';
    }

    public function applyOptions(array $options): void
    {
        parent::applyOptions($options);
    }
}
