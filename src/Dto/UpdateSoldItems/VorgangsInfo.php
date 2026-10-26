<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateSoldItems;

use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;
use Wundii\Structron\Attribute\Description;

final readonly class VorgangsInfo implements RequestDtoXmlInterface
{
    public function __construct(
        #[Description('Overwrites the existing value; an empty string removes it, null leaves it unchanged')]
        private ?string $VorgangsInfo1 = null,
        #[Description('Overwrites the existing value; an empty string removes it, null leaves it unchanged')]
        private ?string $VorgangsInfo2 = null,
        #[Description('Overwrites the existing value; an empty string removes it, null leaves it unchanged')]
        private ?string $VorgangsInfo3 = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $vorgangsInfo = $simpleXml->addChild('VorgangsInfo');
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
