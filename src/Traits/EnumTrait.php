<?php
namespace Sezer\EnumHelpers\Traits;
use Sezer\EnumHelpers\Exceptions\InvalidEnumKeyException;

trait EnumTrait
{
    protected static function casesAssoc(): array
    {
        $assoc = [];
        foreach (self::cases() as $case) {
            $assoc[$case->name] = $case;
        }
        return $assoc;
    }

    protected static function validateKeys(array $keys): void
    {
        $validKeys = array_keys(static::casesAssoc());
        $invalid   = array_diff($keys, $validKeys);

        if (!empty($invalid)) {
            throw new InvalidEnumKeyException(static::class, $invalid);
        }
    }

    public static function only(array $keys): array
    {
        static::validateKeys($keys);
        $cases = static::casesAssoc();
        return array_intersect_key($cases, array_flip($keys));
    }

    public static function except(array $keys): array
    {
        static::validateKeys($keys);
        $cases = static::casesAssoc();
        return array_diff_key($cases, array_flip($keys));
    }

    public static function onlyList(array $keys): array
    {
        return array_values(
            array_map(
                fn ($case) => $case->value,
                self::only($keys)
            )
        );
    }

    public static function exceptList(array $keys): array
    {
        return array_values(
            array_map(
                fn ($case) => $case->value,
                self::except($keys)
            )
        );
    }

}