<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ShopResponse implements ResponseDtoInterface
{
    public function __construct(
        private ?int $aid = null,
        private ?string $uid = null,
        private ?int $kundenNr = null,
        private ?int $ekundenNr = null,
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

    public function getEkundenNr(): ?int
    {
        return $this->ekundenNr;
    }

    public function setEkundenNr(?int $ekundenNr): void
    {
        $this->ekundenNr = $ekundenNr;
    }

    public function getKundenNr(): ?int
    {
        return $this->kundenNr;
    }

    public function setKundenNr(?int $kundenNr): void
    {
        $this->kundenNr = $kundenNr;
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
