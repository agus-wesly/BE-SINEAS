<?php

namespace App\Traits\Accessor;

trait StatusSelected
{
    public const STATUS_ACTIVE = [
        1 => 'Active',
        0 => 'nonactive'
    ];

    public function getStatusSelectedAttribute(): string
    {
        return self::STATUS_ACTIVE[$this->status];
    }

    public function getStatusSelectedClassAttribute(): string
    {
        return $this->status ? 'badge badge-success' : 'badge badge-danger';
    }
}
