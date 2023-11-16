<?php

namespace App\Models;

use App\Traits\Mutator\GenUid;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\QueryException;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Boot function from Laravel.
     */
    protected static function boot(): void
    {
        parent::boot();
    
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = $model->uid();
            }
    
            $maxAttempts = 10000;
            $attempts = 0;
    
            do {
                // Membuat kode baru dengan mengambil kode terakhir dan menambahkannya dengan 1
                $lastCode = self::query()->max('code');
                $model->code = $lastCode ? ++$lastCode : 'TRX-1';
    
                try {
                    // Menyimpan model ke database
                    $model->save();
                    // Jika berhasil, keluar dari loop
                    break;
                } catch (QueryException $exception) {
                    // Jika terjadi kesalahan karena duplicate entry, coba lagi
                    if ($exception->getCode() == '23000') {
                        $attempts++;
                    } else {
                        // Jika terjadi kesalahan lain, lemparkan kembali exception
                        throw $exception;
                    }
                }
            } while ($attempts < $maxAttempts);
    
            if ($attempts === $maxAttempts) {
                throw new \Exception("Unable to generate a unique transaction code after $maxAttempts attempts.");
            }
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }

    /**
     * gen uid
     * @param int $limit
     * @return false|string
     */
    public function uid($limit = 16): false|string
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
