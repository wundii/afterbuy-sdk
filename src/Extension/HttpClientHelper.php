<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Extension;

use Symfony\Component\HttpClient\HttpClientTrait;

class HttpClientHelper
{
    use HttpClientTrait;

    public const URI_MAX_LENGTH = 2048;

    /**
     * @param string[] $query
     */
    public static function prepareUri(string $url, array $query): string
    {
        $uriArray = self::parseUrl($url, $query);
        $uriArray = self::resolveUrl($uriArray, null);
        return implode('', $uriArray);
    }

    /**
     * @param string[] $query
     */
    public static function uriLength(string $url, array $query): int
    {
        $uri = self::prepareUri($url, $query);
        return strlen($uri);
    }
}
