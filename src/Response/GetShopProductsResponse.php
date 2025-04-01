<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\GetShopProducts\PaginationResult;
use AfterbuySdk\Dto\GetShopProducts\Products;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<Products|PaginationResult>
 */
final class GetShopProductsResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return Products
     */
    public function getResult(): AfterbuyDtoInterface
    {
        $content = $this->content;

        $matches = [];
        preg_match('/<LastProductID>(.*)<\/LastProductID>/s', $content, $matches);
        $lastProductId = $matches[1] ?? null;
        $lastProductId = is_numeric($lastProductId) ? (int) $lastProductId : null;

        $matches = [];
        preg_match('/<PaginationResult>(.*)<\/PaginationResult>/s', $content, $matches);
        $paginationContent = $matches[1] ?? null;
        $paginationResult = null;
        if ($paginationContent !== null) {
            $paginationContent = '<?xml version="1.0" encoding="UTF-8"?><root>' . $paginationContent . '</root>';
            /** @var PaginationResult $paginationResult */
            $paginationResult = $this->dataMapper->xml($paginationContent, PaginationResult::class);
        }

        $content = (string) preg_replace('/<LastProductID>(.*)<\/LastProductID>/i', '', $content);

        /** @var Products $shopProducts */
        $shopProducts = $this->dataMapper->xml($content, Products::class, ['Result'], true);
        $shopProducts->setLastProductId($lastProductId);
        $shopProducts->setPaginationResult($paginationResult);

        return $shopProducts;
    }
}
