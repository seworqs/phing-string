<?php

namespace Seworqs\Phing\String\Task\Path\Operation;

use Seworqs\Commons\String\Helper\PathHelper;

class PrependPathOperation implements PathOperationInterface
{
    protected string $name;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function apply(PathHelper $path): PathHelper
    {
        return $path->prependSegment($this->name);
    }
}
