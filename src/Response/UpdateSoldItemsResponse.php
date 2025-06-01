<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * Afterbuy returns only warnings and errors, no data.
 * @phpstan-ignore-next-line
 */
final class UpdateSoldItemsResponse implements ResponseInterface
{
    use ResponseTrait;

    public function getResult(): null
    {
        return null;
    }
}
