<?php

declare(strict_types=1);

namespace Wakeapp\Component\Enumer;

use function is_string;
use function mb_strtolower;

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
     * @param string|int|float|null $value
     * @param bool $isConvertToLowercase
     *
     * @return string|null
     */
    public function normalize(string $enumClass, $value, bool $isConvertToLowercase = true): ?string
    {
        if ($isConvertToLowercase && is_string($value)) {
            $value = mb_strtolower($value);
        }

        $enum = $this->enumRegistry->getEnum($enumClass, EnumRegistry::TYPE_COMBINE_NORMALIZE);

        return $enum[$value] ?? null;
    }
}
