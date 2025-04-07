<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetAfterbuyTime;

use DateTimeInterface;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class AfterbuyTime implements AfterbuyDtoInterface
{
    public function __construct(
        private DateTimeInterface $afterbuyTimeStamp,
        private DateTimeInterface $afterbuyUniversalTimeStamp,
    ) {
    }

    public function getAfterbuyTimeStamp(): DateTimeInterface
    {
        return $this->afterbuyTimeStamp;
    }

    public function setAfterbuyTimeStamp(DateTimeInterface $afterbuyTimeStamp): void
    {
        $this->afterbuyTimeStamp = $afterbuyTimeStamp;
    }

    public function getAfterbuyUniversalTimeStamp(): DateTimeInterface
    {
        return $this->afterbuyUniversalTimeStamp;
    }

    public function setAfterbuyUniversalTimeStamp(DateTimeInterface $afterbuyUniversalTimeStamp): void
    {
        $this->afterbuyUniversalTimeStamp = $afterbuyUniversalTimeStamp;
    }
}
