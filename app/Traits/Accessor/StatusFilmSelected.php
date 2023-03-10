<?php

namespace App\Traits\Accessor;

trait StatusFilmSelected
{
    public const STATUS_FILM_SELECTED = [
        'active' => 'Active',
        'comingsoon' => 'Coming Soon',
        'expired' => 'expired'
    ];

    public function getStatusFilmSelectedAttribute()
    {
        return self::STATUS_FILM_SELECTED[$this->status];
    }

    public function getStatusFilmSelectedClassAttribute()
    {
         switch ($this->status) {
             case 'active':
                 return 'bg-success';
                 break;
             case 'comingsoon':
                 return 'bg-warning';
                 break;
             case 'expired':
                 return 'bg-danger';
                 break;
             default:
                 return 'bg-secondary';
                 break;
         }
    }

}
