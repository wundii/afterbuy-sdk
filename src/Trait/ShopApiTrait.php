<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Trait;

use DateTimeInterface;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;

trait ShopApiTrait
{
    /**
     * @param array<string,string> $data
     * @return array<string,string>
     */
    public function addNumber(array $data, string $key, null|int|float $value): array
    {
        if ($value === null) {
            return $data;
        }

        if (is_float($value)) {
            $value = number_format($value, 2, ',', '');
        }

        $data[$key] = (string) $value;

        return $data;
    }

    /**
     * @param array<string,string> $data
     * @return array<string,string>
     */
    public function addString(array $data, string $key, ?string $value): array
    {
        if ($value === null) {
            return $data;
        }

        if ($value === '') {
            return $data;
        }

        $data[$key] = $value;

        return $data;
    }

    /**
     * @param array<string,string> $data
     * @return array<string,string>
     */
    public function addBool(array $data, string $key, ?bool $value): array
    {
        if ($value === null) {
            return $data;
        }

        $data[$key] = $value ? '1' : '0';

        return $data;
    }

    /**
     * @param array<string,string> $data
     * @return array<string,string>
     */
    public function addDateTime(array $data, string $key, ?DateTimeInterface $dateTime): array
    {
        if (! $dateTime instanceof DateTimeInterface) {
            return $data;
        }

        $data[$key] = $dateTime->format('d.m.Y H:i:s');

        return $data;
    }

    /**
     * @param array<string,string> $data
     * @return array<string,string>
     */
    public function addObject(array $data, ?object $object, ?int $index = null): array
    {
        if (! $object instanceof RequestDtoArrayInterface) {
            return $data;
        }

        return $object->toArray($data, $index);
    }
}
