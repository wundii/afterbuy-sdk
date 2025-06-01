<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetShopCatalogs\Catalogs;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<Catalogs>
 */
final class GetShopCatalogsResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return Catalogs
     */
    public function getResult(): ResponseDtoInterface
    {
        return $this->dataMapper->xml($this->content, Catalogs::class, ['Result'], true);
    }
}
