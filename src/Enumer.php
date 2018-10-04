<?php

declare(strict_types=1);

namespace Wakeapp\Component\Enumer;

/**
 * Class Enumer
 */
class Enumer
{
    /**
     * @var EnumRegistry
     */
    private $enumRegistry;

    /**
     * @param EnumRegistry $enumRegistry
     */
    public function __construct(EnumRegistry $enumRegistry)
    {
        $this->enumRegistry = $enumRegistry;
    }

    /**
     * @param string $enumClass
     *
     * @return array
     */
    public function getList(string $enumClass): array
    {
        return $this->enumRegistry->getEnum($enumClass, EnumRegistry::TYPE_ORIGINAL);
    }

    /**
     * @param string $enumClass
     *
     * @return array
     */
    public function getCombineList(string $enumClass): array
    {
        return $this->enumRegistry->getEnum($enumClass, EnumRegistry::TYPE_COMBINE);
    }

    /**
     * @param string $enumClass
     * @param string $value
     * @param bool $isConvertToLowercase
     *
     * @return int
     */
    public function getEnumBit(string $enumClass, string $value, bool $isConvertToLowercase = true): int
    {
        $enum = $this->enumRegistry->getEnum($enumClass, EnumRegistry::TYPE_COMBINE_NORMALIZE);

        if ($isConvertToLowercase) {
            $value = mb_strtolower($value);
        }

        $index = 0;

        foreach (array_keys($enum) as $constant) {
            if ($constant === $value) {
                return 1 << $index;
            }

            $index++;
        }

        return 0;
    }

    /**
     * @param string $enumClass
     * @param string $value
     * @param bool $isConvertToLowercase
     *
     * @return null|string
     */
    public function normalize(string $enumClass, $value, bool $isConvertToLowercase = true): ?string
    {
        if ($isConvertToLowercase) {
            $value = mb_strtolower($value);
        }

        $enum = $this->enumRegistry->getEnum($enumClass, EnumRegistry::TYPE_COMBINE_NORMALIZE);

        return $enum[$value] ?? null;
    }
}
