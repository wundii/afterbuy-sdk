<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateSoldItems;

use DateTimeInterface;
use Wundii\AfterbuySdk\Extension\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final readonly class PaymentInfo implements RequestDtoXmlInterface
{
    public function __construct(
        private ?string $paymentMethod = null,
        private ?DateTimeInterface $paymentDate = null,
        private ?string $paymentTransactionId = null,
        private ?float $alreadyPaid = null,
        private ?float $paymentAdditionalCost = null,
        private ?float $sendPaymentMail = null,
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $paymentInfo = $simpleXml->addChild('PaymentInfo');
        $paymentInfo->addString('PaymentMethod', $this->paymentMethod);
        $paymentInfo->addDateTime('PaymentDate', $this->paymentDate);
        $paymentInfo->addString('PaymentTransactionID', $this->paymentTransactionId);
        $paymentInfo->addNumber('AlreadyPaid', $this->alreadyPaid);
        $paymentInfo->addNumber('PaymentAdditionalCost', $this->paymentAdditionalCost);
        $paymentInfo->addNumber('SendPaymentMail', $this->sendPaymentMail);
    }

    public function getAlreadyPaid(): ?float
    {
        return $this->alreadyPaid;
    }

    public function getPaymentAdditionalCost(): ?float
    {
        return $this->paymentAdditionalCost;
    }

    public function getPaymentDate(): ?DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function getPaymentTransactionId(): ?string
    {
        return $this->paymentTransactionId;
    }

    public function getSendPaymentMail(): ?float
    {
        return $this->sendPaymentMail;
    }
}
