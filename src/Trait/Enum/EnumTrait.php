<?php 
namespace OSW3\Blog\Trait\Enum;

trait EnumTrait
{
    public static function fromDefault(string $case, string $default = 'default')
    {
        if ($try = self::tryFrom($case))
        {
            return $try;
        }
        return self::tryFrom($default);
    }

    public static function toString(string $separator=',', string $start='', string $end=''): string
    {
        $cases = self::cases();
        $map = array_map(fn($case) => $case->name, $cases);
        return $start . implode($separator, $map) . $end;
    }

    public static function toArray(): array 
    {
        $output = [];
        foreach (self::cases() as $case) {
            $output[$case->name] = $case->value;
        }
        return $output;
    }

    public static function fromString(string $case): ?self
    {
        return self::tryFrom($case);
    }
}