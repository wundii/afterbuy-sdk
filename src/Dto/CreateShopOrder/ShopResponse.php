<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ShopResponse implements ResponseDtoInterface
{
    public function __construct(
        private ?int $aid = null,
        private ?string $uid = null,
        private ?int $kundeNr = null,
        private ?int $ekundeNr = null,
    ) {
    }

    public function getAid(): ?int
    {
        return $this->aid;
    }

    public function setAid(?int $aid): void
    {
        $this->aid = $aid;
    }

    public function getEkundeNr(): ?int
    {
        return $this->ekundeNr;
    }

    public function setEkundeNr(?int $ekundeNr): void
    {
        $this->ekundeNr = $ekundeNr;
    }

    public function getKundeNr(): ?int
    {
        return $this->kundeNr;
    }

    public function setKundeNr(?int $kundeNr): void
    {
        $this->kundeNr = $kundeNr;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(?string $uid): void
    {
        $this->uid = $uid;
    }
}
