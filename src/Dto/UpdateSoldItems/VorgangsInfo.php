<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class VorgangsInfo implements AfterbuyAppendXmlContentInterface
{
    public function __construct(
        private ?string $VorgangsInfo1 = null,
        private ?string $VorgangsInfo2 = null,
        private ?string $VorgangsInfo3 = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $vorgangsInfo = $xml->addChild('VorgangsInfo');
        $vorgangsInfo->addString('VorgangsInfo1', $this->VorgangsInfo1);
        $vorgangsInfo->addString('VorgangsInfo2', $this->VorgangsInfo2);
        $vorgangsInfo->addString('VorgangsInfo3', $this->VorgangsInfo3);
    }

    public function getVorgangsInfo1(): ?string
    {
        return $this->VorgangsInfo1;
    }

    public function getVorgangsInfo2(): ?string
    {
        return $this->VorgangsInfo2;
    }

    public function getVorgangsInfo3(): ?string
    {
        return $this->VorgangsInfo3;
    }
}
