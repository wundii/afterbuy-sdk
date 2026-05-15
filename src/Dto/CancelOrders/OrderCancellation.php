<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CancelOrders;

use Wundii\AfterbuySdk\Enum\StockBookingEnum;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final class OrderCancellation implements RequestDtoXmlInterface
{
    public function __construct(
        private int $orderId,
        private ?StockBookingEnum $stockBookingEnum = null,
        private ?bool $hideOrder = null,
        private ?int $markId = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $cancellation = $simpleXml->addChild('OrderCancellation');
        $cancellation->addNumber('OrderId', $this->orderId);
        $cancellation->addNumber('StockBooking', $this->stockBookingEnum?->value);
        $cancellation->addBool('HideOrder', $this->hideOrder);
        $cancellation->addNumber('MarkId', $this->markId);
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getStockBooking(): ?StockBookingEnum
    {
        return $this->stockBookingEnum;
    }

    public function setStockBooking(?StockBookingEnum $stockBookingEnum): void
    {
        $this->stockBookingEnum = $stockBookingEnum;
    }

    public function getHideOrder(): ?bool
    {
        return $this->hideOrder;
    }

    public function setHideOrder(?bool $hideOrder): void
    {
        $this->hideOrder = $hideOrder;
    }

    public function getMarkId(): ?int
    {
        return $this->markId;
    }

    public function setMarkId(?int $markId): void
    {
        $this->markId = $markId;
    }
}
