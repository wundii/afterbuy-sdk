<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;

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
