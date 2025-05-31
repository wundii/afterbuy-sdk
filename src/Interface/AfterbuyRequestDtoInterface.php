<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;

interface AfterbuyRequestDtoInterface
{
    public function appendXmlContent(SimpleXMLExtend $xml): void;
}
