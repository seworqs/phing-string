<?php

namespace Seworqs\Phing\String\Task\Path\Operation;

use Seworqs\Commons\String\Helper\PathHelper;

interface PathOperationInterface
{
    public function apply(PathHelper $path): PathHelper;
}