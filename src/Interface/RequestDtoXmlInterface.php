<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;

interface RequestDtoXmlInterface extends RequestDtoInterface
{
    public function appendXmlContent(SimpleXMLExtend $simpleXml): void;
}
