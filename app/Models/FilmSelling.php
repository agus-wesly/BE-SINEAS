<?php

namespace App\Models;

use App\Traits\Accessor\ISFeeSelected;
use App\Traits\Accessor\StatusFilmSelected;
use App\Traits\Mutator\GenUid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmSelling extends Model
{
    use HasFactory;
    use GenUid;
    use ISFeeSelected;
    use StatusFilmSelected;

    protected $guarded = ['id'];

    public function film(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Film::class);
    }

    public function sellingPrice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FilmSellingPrice::class, 'film_selling_price_id', 'id');
    }
}
