<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestDtoInterface;

final readonly class AddBaseProduct implements AfterbuyRequestDtoInterface
{
    public function __construct(
        private ?int $productId = null,
        private ?string $productLabel = null,
        private ?int $productPos = null,
        private ?bool $defaultProduct = null,
        private ?int $productQuantity = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $productLabel = $this->productLabel;
        if (is_string($productLabel)) {
            $productLabel = substr($productLabel, 0, 50);
        }

        $addBaseProduct = $xml->addChild('AddBaseProduct');
        $addBaseProduct->addNumber('ProductID', $this->productId);
        $addBaseProduct->addString('ProductLabel', $productLabel);
        $addBaseProduct->addNumber('ProductPos', $this->productPos);
        $addBaseProduct->addBool('DefaultProduct', $this->defaultProduct);
        $addBaseProduct->addNumber('ProductQuantity', $this->productQuantity);
    }

    public function getDefaultProduct(): ?bool
    {
        return $this->defaultProduct;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getProductLabel(): ?string
    {
        return $this->productLabel;
    }

    public function getProductPos(): ?int
    {
        return $this->productPos;
    }

    public function getProductQuantity(): ?int
    {
        return $this->productQuantity;
    }
}
