<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Tests;

use DOMDocument;

final readonly class DomFormatter
{
    public static function xml(string $content): string
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($content);

        $formatedString = $dom->saveXML();
        if ($formatedString === false) {
            return 'Failed to format XML';
        }

        return str_replace('    ', '  ', $formatedString);
    }
}
