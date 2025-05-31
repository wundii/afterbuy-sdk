<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

interface AfterbuyRequestDtoArrayInterface extends AfterbuyRequestDtoInterface
{
    /**
     * @param array<string,string> $data
     * @return array<string,string>
     */
    public function toArray(array $data): array;
}
