<?php

declare(strict_types=1);

namespace AfterbuySdk\Interface;

use AfterbuySdk\Extends\SimpleXMLExtend;

interface AfterbuyAppendXmlContentInterface
{
    public function appendXmlContent(SimpleXMLExtend $xml): void;
}
