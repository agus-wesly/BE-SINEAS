<?php

namespace App\Enums;

enum TypeFilm: string
{
    case Thumbnail = 'thumbnail';
    case Background = 'background';

    public static function getValues(): array
    {
        return [
            self::Thumbnail,
            self::Background,
        ];
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::getValues());
    }

    public static function getLabel(string $value): string
    {
        return match ($value) {
            self::Thumbnail => 'Thumbnail',
            self::Background => 'Background',
            default => '',
        };
    }
}
