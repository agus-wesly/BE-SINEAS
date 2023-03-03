<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public CONST STATUS_ACTIVE = [
        1 => 'Active',
        2 => 'nonactive'
    ];
}
