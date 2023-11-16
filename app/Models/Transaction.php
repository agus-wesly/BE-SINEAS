<?php
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

            $model->code = self::generateUniqueCode($maxAttempts);
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
     * Generate a unique transaction code.
     *
     * @param int $maxAttempts
     * @return string
     * @throws \Exception
     */
    protected static function generateUniqueCode($maxAttempts)
    {
        $prefix = 'TRX-';
        $length = 6;

        $code = IdGenerator::generate([
            'table' => 'transactions',
            'field' => 'code',
            'length' => $length,
            'prefix' => $prefix,
        ]);

        $attempts = 0;

        while ($attempts < $maxAttempts) {
            try {
                // Check if the generated code already exists
                self::query()->where('code', $code)->firstOrFail();
                // If it exists, generate a new code
                $code = IdGenerator::generate([
                    'table' => 'transactions',
                    'field' => 'code',
                    'length' => $length,
                    'prefix' => $prefix,
                ]);
            } catch (QueryException $exception) {
                // If firstOrFail fails, it means the code is unique
                break;
            }

            $attempts++;
        }

        if ($attempts === $maxAttempts) {
            throw new \Exception("Unable to generate a unique transaction code after $maxAttempts attempts.");
        }

        return $code;
    }

    /**
     * Generate a UID.
     *
     * @param int $limit
     * @return false|string
     */
    public function uid($limit = 16): false|string
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
