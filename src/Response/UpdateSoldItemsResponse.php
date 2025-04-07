<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Interface\AfterbuyResponseInterface;
use Wundii\AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * Afterbuy returns only warnings and errors, no data.
 * @phpstan-ignore-next-line
 */
final class UpdateSoldItemsResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    public function getResult(): null
    {
        return null;
    }
}
