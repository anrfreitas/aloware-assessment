<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

abstract class AbstractTransFormer extends TransformerAbstract
{
    private bool $checkRelations = false;

    protected function checkingRelation($bool = true): self
    {
        $this->checkRelations = $bool;
        return $this;
    }

    protected function shouldCheckRelation(): bool
    {
        return $this->checkRelations;
    }
}
