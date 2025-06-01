<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Extension;

use Symfony\Component\HttpClient\HttpClientTrait;

class HttpClientHelper
{
    use HttpClientTrait;

    /**
     * @param string[] $query
     */
    public static function prepareUri(string $url, array $query): string
    {
        // This method can be used to get a URL with the HttpClientTrait
        $uriArray = self::parseUrl($url, $query);
        $uriArray = self::resolveUrl($uriArray, null);
        return implode('', $uriArray);
    }
}
