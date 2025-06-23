<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetAfterbuyTime;

use DateTimeInterface;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\DataMapper\Enum\ApproachEnum;
use Wundii\Structron\Attribute\Approach;
use Wundii\Structron\Attribute\Description;
use Wundii\Structron\Attribute\Structron;

#[Structron('A simple DTO to hold the Afterbuy time and universal time stamp.')]
#[Approach(ApproachEnum::CONSTRUCTOR)]
final class AfterbuyTime implements ResponseDtoInterface
{
    public function __construct(
        #[Description('Local time stamp of Afterbuy.')]
        private DateTimeInterface $afterbuyTimeStamp,
        #[Description('UTC time stamp of Afterbuy.')]
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
