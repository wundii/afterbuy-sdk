<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use DateTimeInterface;
use InvalidArgumentException;

final readonly class Order implements AfterbuyAppendXmlContentInterface
{
    /**
     * @param string[] $tags
     * @param Attribute[] $attributes
     */
    public function __construct(
        private ?int $orderId = null,
        private ?int $itemId = null,
        private ?int $userDefindedFlag = null,
        private ?int $productId = null,
        private ?string $additionalInfo = null,
        private ?DateTimeInterface $mailDate = null,
        private ?DateTimeInterface $reminderMailDate = null,
        private ?string $userComment = null,
        private ?string $orderMemo = null,
        private ?string $invoiceMemo = null,
        private ?bool $orderExported = null,
        private ?DateTimeInterface $invoiceDate = null,
        private ?int $invoiceNumber = null,
        private ?bool $hideOrder = null,
        private ?DateTimeInterface $reminder1Date = null,
        private ?DateTimeInterface $reminder2Date = null,
        private ?DateTimeInterface $feedbackDate = null,
        private ?DateTimeInterface $xmlDate = null,
        private ?BuyerInfo $buyerInfo = null,
        private ?PaymentInfo $paymentInfo = null,
        private ?ShippingInfo $shippingInfo = null,
        private ?VorgangsInfo $vorgangsInfo = null,
        private array $tags = [],
        private array $attributes = [],
    ) {
        if ($this->orderId === null && $this->itemId === null && $this->userDefindedFlag === null) {
            throw new InvalidArgumentException('At least one of orderId, itemId or userDefindedFlag must be set');
        }
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $order = $xml->addChild('Order');
        $order->addNumber('OrderID', $this->orderId);
        $order->addNumber('ItemID', $this->itemId);
        $order->addNumber('UserDefindedFlag', $this->userDefindedFlag);
        $order->addNumber('ProductID', $this->productId);
        $order->addString('AdditionalInfo', $this->additionalInfo);
        $order->addDateTime('MailDate', $this->mailDate);
        $order->addDateTime('ReminderMailDate', $this->reminderMailDate);
        $order->addString('UserComment', $this->userComment);
        $order->addString('OrderMemo', $this->orderMemo);
        $order->addString('InvoiceMemo', $this->invoiceMemo);
        $order->addBool('OrderExported', $this->orderExported);
        $order->addDateTime('InvoiceDate', $this->invoiceDate);
        $order->addNumber('InvoiceNumber', $this->invoiceNumber);
        $order->addBool('HideOrder', $this->hideOrder);
        $order->addDateTime('Reminder1Date', $this->reminder1Date);
        $order->addDateTime('Reminder2Date', $this->reminder2Date);
        $order->addDateTime('FeedbackDate', $this->feedbackDate);
        $order->addDateTime('XmlDate', $this->xmlDate);
        $this->buyerInfo?->appendXmlContent($order);
        $this->paymentInfo?->appendXmlContent($order);
        $this->shippingInfo?->appendXmlContent($order);
        $this->vorgangsInfo?->appendXmlContent($order);

        if ($this->tags !== []) {
            $tags = $order->addChild('Tags');
            foreach ($this->tags as $tag) {
                $tags->addString('Tag', $tag);
            }
        }

        if ($this->attributes !== []) {
            $attributes = $order->addChild('Attributes');
            foreach ($this->attributes as $attribute) {
                $attribute->appendXmlContent($attributes);
            }
        }
    }

    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    /**
     * @return Attribute[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getBuyerInfo(): ?BuyerInfo
    {
        return $this->buyerInfo;
    }

    public function getFeedbackDate(): ?DateTimeInterface
    {
        return $this->feedbackDate;
    }

    public function getHideOrder(): ?bool
    {
        return $this->hideOrder;
    }

    public function getInvoiceDate(): ?DateTimeInterface
    {
        return $this->invoiceDate;
    }

    public function getInvoiceMemo(): ?string
    {
        return $this->invoiceMemo;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoiceNumber;
    }

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function getMailDate(): ?DateTimeInterface
    {
        return $this->mailDate;
    }

    public function getOrderExported(): ?bool
    {
        return $this->orderExported;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function getOrderMemo(): ?string
    {
        return $this->orderMemo;
    }

    public function getPaymentInfo(): ?PaymentInfo
    {
        return $this->paymentInfo;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getReminder1Date(): ?DateTimeInterface
    {
        return $this->reminder1Date;
    }

    public function getReminder2Date(): ?DateTimeInterface
    {
        return $this->reminder2Date;
    }

    public function getReminderMailDate(): ?DateTimeInterface
    {
        return $this->reminderMailDate;
    }

    public function getShippingInfo(): ?ShippingInfo
    {
        return $this->shippingInfo;
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    public function getUserComment(): ?string
    {
        return $this->userComment;
    }

    public function getUserDefindedFlag(): ?int
    {
        return $this->userDefindedFlag;
    }

    public function getVorgangsInfo(): ?VorgangsInfo
    {
        return $this->vorgangsInfo;
    }

    public function getXmlDate(): ?DateTimeInterface
    {
        return $this->xmlDate;
    }
}
