<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetProductDiscounts;

use DateTimeInterface;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;

final class ProductDiscount implements ResponseDtoInterface
{
    public function __construct(
        private int $productId,
        private int $controlId,
        private ?float $amountDiscount = null,
        private ?float $percentDiscount = null,
        private ?DateTimeInterface $startDate = null,
        private ?DateTimeInterface $endDate = null,
        private ?DateTimeInterface $itemLastUserModificationDate = null,
        private ?string $priceType = null,
        private ?string $newPriceType = null,
        private ?int $timeLeftInMinutes = null,
    ) {
    }

    public function getAmountDiscount(): ?float
    {
        return $this->amountDiscount;
    }

    public function setAmountDiscount(?float $amountDiscount): void
    {
        $this->amountDiscount = $amountDiscount;
    }

    public function getControlId(): int
    {
        return $this->controlId;
    }

    public function setControlId(int $controlId): void
    {
        $this->controlId = $controlId;
    }

    public function getEndDate(): ?DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getItemLastUserModificationDate(): ?DateTimeInterface
    {
        return $this->itemLastUserModificationDate;
    }

    public function setItemLastUserModificationDate(?DateTimeInterface $itemLastUserModificationDate): void
    {
        $this->itemLastUserModificationDate = $itemLastUserModificationDate;
    }

    public function getNewPriceType(): ?string
    {
        return $this->newPriceType;
    }

    public function setNewPriceType(?string $newPriceType): void
    {
        $this->newPriceType = $newPriceType;
    }

    public function getPercentDiscount(): ?float
    {
        return $this->percentDiscount;
    }

    public function setPercentDiscount(?float $percentDiscount): void
    {
        $this->percentDiscount = $percentDiscount;
    }

    public function getPriceType(): ?string
    {
        return $this->priceType;
    }

    public function setPriceType(?string $priceType): void
    {
        $this->priceType = $priceType;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getStartDate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getTimeLeftInMinutes(): ?int
    {
        return $this->timeLeftInMinutes;
    }

    public function setTimeLeftInMinutes(?int $timeLeftInMinutes): void
    {
        $this->timeLeftInMinutes = $timeLeftInMinutes;
    }
}
