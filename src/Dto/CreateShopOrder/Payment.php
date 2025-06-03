<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\PaymentMethodIdEnum;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Payment implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    public function __construct(
        public ?PaymentMethodIdEnum $paymentMethodIdEnum = null,
        #[Assert\Length(max: 150)]
        public ?string $paymentMethodCustom = null,
        public ?bool $payed = null,
        public ?DateTimeInterface $payDate = null,
        public ?float $paymentMethodSurcharge = null,
        #[Assert\Length(max: 20)]
        public ?string $paymentStatus = null,
        #[Assert\Length(max: 25)]
        public ?string $paymentTransactionId = null,
        #[Assert\Length(max: 100)]
        public ?string $bankAccountOwner = null,
        #[Assert\Length(max: 50)]
        public ?string $bankName = null,
        #[Assert\Regex(
            pattern: '/^\d{10,18}$/',
            message: 'Bank account number must be between 10 and 18 digits long.'
        )]
        public ?string $bankAccountNumber = null,
        #[Assert\Regex(
            pattern: '/^\d{8}$/',
            message: 'BLZ must be exactly 8 digits long.'
        )]
        public ?string $blz = null,
        #[Assert\Bic]
        public ?string $bic = null,
        #[Assert\Iban]
        public ?string $iban = null,
        #[Assert\Length(max: 50)]
        public ?string $billSafeTransactionId = null,
        #[Assert\Length(max: 50)]
        public ?string $billSafeOrderNumber = null,
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data, ?int $index = null): array
    {
        if ($this->paymentMethodIdEnum instanceof PaymentMethodIdEnum) {
            $data = $this->addNumber($data, 'ZahlartID', $this->paymentMethodIdEnum->value);
        } else {
            $data = $this->addString($data, 'Zahlart', $this->paymentMethodCustom);
        }

        $data = $this->addBool($data, 'SetPay', $this->payed);
        $data = $this->addDateTime($data, 'SetPayDate', $this->payDate);
        $data = $this->addNumber($data, 'ZahlartenAufschlag', $this->paymentMethodSurcharge);
        $data = $this->addString($data, 'PaymentStatus', $this->paymentStatus);
        $data = $this->addString($data, 'PaymentTransactionID', $this->paymentTransactionId);
        $data = $this->addString($data, 'Kontoinhaber', $this->bankAccountOwner);
        $data = $this->addString($data, 'Bankname', $this->bankName);
        $data = $this->addString($data, 'Kontonummer', $this->bankAccountNumber);
        $data = $this->addString($data, 'BLZ', $this->blz);
        $data = $this->addString($data, 'BIC', $this->bic);
        $data = $this->addString($data, 'IBAN', $this->iban);
        $data = $this->addString($data, 'BillsafeTransactionID', $this->billSafeTransactionId);
        return $this->addString($data, 'BillsafeOrderNumber', $this->billSafeOrderNumber);
    }
}
