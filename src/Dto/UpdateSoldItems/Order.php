<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateSoldItems;

use DateTimeInterface;
use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final class Order implements RequestDtoXmlInterface
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

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $order = $simpleXml->addChild('Order');
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

    public function setAdditionalInfo(?string $additionalInfo): void
    {
        $this->additionalInfo = $additionalInfo;
    }

    /**
     * @return Attribute[]
     */
    #[Assert\Count(min: 0)]
    #[Assert\Valid]
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param Attribute[] $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    #[Assert\Valid]
    public function getBuyerInfo(): ?BuyerInfo
    {
        return $this->buyerInfo;
    }

    public function setBuyerInfo(?BuyerInfo $buyerInfo): void
    {
        $this->buyerInfo = $buyerInfo;
    }

    public function getFeedbackDate(): ?DateTimeInterface
    {
        return $this->feedbackDate;
    }

    public function setFeedbackDate(?DateTimeInterface $feedbackDate): void
    {
        $this->feedbackDate = $feedbackDate;
    }

    public function getHideOrder(): ?bool
    {
        return $this->hideOrder;
    }

    public function setHideOrder(?bool $hideOrder): void
    {
        $this->hideOrder = $hideOrder;
    }

    public function getInvoiceDate(): ?DateTimeInterface
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(?DateTimeInterface $invoiceDate): void
    {
        $this->invoiceDate = $invoiceDate;
    }

    public function getInvoiceMemo(): ?string
    {
        return $this->invoiceMemo;
    }

    public function setInvoiceMemo(?string $invoiceMemo): void
    {
        $this->invoiceMemo = $invoiceMemo;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(?int $invoiceNumber): void
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function setItemId(?int $itemId): void
    {
        $this->itemId = $itemId;
    }

    public function getMailDate(): ?DateTimeInterface
    {
        return $this->mailDate;
    }

    public function setMailDate(?DateTimeInterface $mailDate): void
    {
        $this->mailDate = $mailDate;
    }

    public function getOrderExported(): ?bool
    {
        return $this->orderExported;
    }

    public function setOrderExported(?bool $orderExported): void
    {
        $this->orderExported = $orderExported;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(?int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getOrderMemo(): ?string
    {
        return $this->orderMemo;
    }

    public function setOrderMemo(?string $orderMemo): void
    {
        $this->orderMemo = $orderMemo;
    }

    #[Assert\Valid]
    public function getPaymentInfo(): ?PaymentInfo
    {
        return $this->paymentInfo;
    }

    public function setPaymentInfo(?PaymentInfo $paymentInfo): void
    {
        $this->paymentInfo = $paymentInfo;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }

    public function getReminder1Date(): ?DateTimeInterface
    {
        return $this->reminder1Date;
    }

    public function setReminder1Date(?DateTimeInterface $reminder1Date): void
    {
        $this->reminder1Date = $reminder1Date;
    }

    public function getReminder2Date(): ?DateTimeInterface
    {
        return $this->reminder2Date;
    }

    public function setReminder2Date(?DateTimeInterface $reminder2Date): void
    {
        $this->reminder2Date = $reminder2Date;
    }

    public function getReminderMailDate(): ?DateTimeInterface
    {
        return $this->reminderMailDate;
    }

    public function setReminderMailDate(?DateTimeInterface $reminderMailDate): void
    {
        $this->reminderMailDate = $reminderMailDate;
    }

    #[Assert\Valid]
    public function getShippingInfo(): ?ShippingInfo
    {
        return $this->shippingInfo;
    }

    public function setShippingInfo(?ShippingInfo $shippingInfo): void
    {
        $this->shippingInfo = $shippingInfo;
    }

    /**
     * @return string[]
     */
    #[Assert\Count(min: 0)]
    #[Assert\All([
        new Assert\Type('string'),
        new Assert\Length(max: 50),
    ])]
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param string[] $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getUserComment(): ?string
    {
        return $this->userComment;
    }

    public function setUserComment(?string $userComment): void
    {
        $this->userComment = $userComment;
    }

    public function getUserDefindedFlag(): ?int
    {
        return $this->userDefindedFlag;
    }

    public function setUserDefindedFlag(?int $userDefindedFlag): void
    {
        $this->userDefindedFlag = $userDefindedFlag;
    }

    #[Assert\Valid]
    public function getVorgangsInfo(): ?VorgangsInfo
    {
        return $this->vorgangsInfo;
    }

    public function setVorgangsInfo(?VorgangsInfo $vorgangsInfo): void
    {
        $this->vorgangsInfo = $vorgangsInfo;
    }

    public function getXmlDate(): ?DateTimeInterface
    {
        return $this->xmlDate;
    }

    public function setXmlDate(?DateTimeInterface $xmlDate): void
    {
        $this->xmlDate = $xmlDate;
    }
}
