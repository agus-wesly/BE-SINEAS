<?php

namespace App\Traits\Accessor;

trait ISFeeSelected
{
    public const IS_FEE_SELECTED = [
        1 => 'Yes',
        0 => 'No'
    ];

    public function getIsFreeSelectedAttribute(): string
    {
        return self::IS_FEE_SELECTED[$this->is_free];
    }

    public function getIsFreeSelectedClassAttribute()
    {
        return $this->is_free ? 'bg-success' : 'bg-danger';
    }
}
