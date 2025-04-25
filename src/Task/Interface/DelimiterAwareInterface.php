<?php

namespace Seworqs\Phing\String\Task\Interface;

interface DelimiterAwareInterface {
    public function isDelimitersExplicitlySet(): bool;
}