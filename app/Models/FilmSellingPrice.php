<?php

namespace App\Models;

use App\Traits\Mutator\GenUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmSellingPrice extends Model
{
    use HasFactory;
    use GenUid;

    protected $guarded = ['id'];
}
