<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\CurrencyEnum;
use Wundii\AfterbuySdk\Enum\CustomerIdentificationEnum;
use Wundii\AfterbuySdk\Enum\NoFeedbackEnum;
use Wundii\AfterbuySdk\Enum\PaymentMethodIdEnum;
use Wundii\AfterbuySdk\Enum\ProductIdentificationEnum;
use Wundii\AfterbuySdk\Enum\StockTypeEnum;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Order implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    /**
     * @param Product[] $products
     */
    public function __construct(
        public CustomerIdentificationEnum $customerIdentificationEnum,
        public ProductIdentificationEnum $productIdentificationEnum,
        public StockTypeEnum $stockTypeEnum,
        public DateTimeInterface $buyDate,
        #[Assert\Valid]
        public Customer $customer,
        #[Assert\Valid]
        public ?DeliveryAddress $deliveryAddress = null,
        #[Assert\Count(min: 1, max: 5)]
        #[Assert\Valid]
        public array $products = [],
        #[Assert\Length(max: 255)]
        public ?string $comment = null,
        public ?bool $useComplWeight = null,
        public ?bool $useProductTaxRate = null,
        #[Assert\Length(max: 150)]
        public ?string $shippingMethod = null,
        #[Assert\Length(max: 150)]
        public ?string $returnCarrier = null,
        public ?float $deliveryCost = null,
        public ?float $paymentMethodSurcharge = null,
        #[Assert\Length(max: 150)]
        public ?string $paymentMethodCustom = null,
        public ?PaymentMethodIdEnum $paymentMethodIdEnum = null,
        #[Assert\Length(max: 50)]
        public ?string $bankName = null,
        #[Assert\Regex(
            pattern: '/^\d{8}$/',
            message: 'BLZ must be exactly 8 digits long.'
        )]
        public ?int $blz = null,
        #[Assert\Regex(
            pattern: '/^\d{10,18}$/',
            message: 'Bank account number must be between 10 and 18 digits long.'
        )]
        public ?int $bankAccountNumber = null,
        #[Assert\Length(max: 100)]
        public ?string $bankAccountOwner = null,
        public ?NoFeedbackEnum $noFeedbackEnum = null,
        public ?bool $noDeliveryCalc = null,
        #[Assert\Length(max: 50)]
        public ?string $shippingGroup = null,
        public ?bool $doNotShowVat = null,
        public ?int $markerId = null,
        public ?bool $noEbayName = null,
        #[Assert\Length(max: 255)]
        public ?string $memo = null,
        #[Assert\Length(max: 255)]
        public ?string $orderInfo1 = null,
        #[Assert\Length(max: 255)]
        public ?string $orderInfo2 = null,
        #[Assert\Length(max: 255)]
        public ?string $orderInfo3 = null,
        #[Assert\Length(max: 40)]
        public ?string $vid = null,
        public ?CurrencyEnum $currencyEnum = null,
        public ?bool $payed = null,
        public ?DateTimeInterface $payDate = null,
        public ?bool $checkVid = null,
        public ?bool $checkPackStation = null,
        public ?bool $overrideMarkId = null,
        #[Assert\Length(max: 50)]
        public ?string $billSafeTransactionId = null,
        #[Assert\Length(max: 50)]
        public ?string $billSafeOrderNumber = null,
        #[Assert\Bic]
        public ?string $bic = null,
        #[Assert\Iban]
        public ?string $iban = null,
        #[Assert\Length(max: 50)]
        public ?string $reference = null,
        #[Assert\Length(max: 20)]
        public ?string $paymentStatus = null,
        #[Assert\Length(max: 25)]
        public ?string $paymentTransactionId = null,
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data, ?int $index = null): array
    {
        $data = $this->addNumber($data, 'Kundenerkennung', $this->customerIdentificationEnum->value);
        $data = $this->addNumber($data, 'Artikelerkennung', $this->productIdentificationEnum->value);
        $data = $this->addString($data, 'Bestandart', $this->stockTypeEnum->value);
        $data = $this->addDateTime($data, 'BuyDate', $this->buyDate);
        $data = $this->addObject($data, $this->customer);
        $data = $this->addObject($data, $this->deliveryAddress);
        $data = $this->addNumber($data, 'PosAnz', count($this->products));

        foreach ($this->products as $index => $product) {
            $data = $this->addObject($data, $product, $index);
        }

        $data = $this->addString($data, 'reference', $this->reference);
        $data = $this->addString($data, 'OrderInfo1', $this->orderInfo1);
        $data = $this->addString($data, 'OrderInfo2', $this->orderInfo2);
        $data = $this->addString($data, 'OrderInfo3', $this->orderInfo3);

        $data = $this->addString($data, 'Kommentar', $this->comment);
        $data = $this->addString($data, 'VMemo', $this->memo);

        $data = $this->addBool($data, 'UseComplWeight', $this->useComplWeight);
        $data = $this->addBool($data, 'UseProductTaxRate', $this->useProductTaxRate);

        $data = $this->addString($data, 'Versandart', $this->shippingMethod);
        $data = $this->addString($data, 'ReturnCarrier', $this->returnCarrier);
        $data = $this->addNumber($data, 'Versandkosten', $this->deliveryCost);
        $data = $this->addNumber($data, 'ZahlartenAufschlag', $this->paymentMethodSurcharge);

        if ($this->paymentMethodIdEnum instanceof PaymentMethodIdEnum) {
            $data = $this->addNumber($data, 'ZahlartID', $this->paymentMethodIdEnum->value);
        } else {
            $data = $this->addString($data, 'Zahlart', $this->paymentMethodCustom);
        }

        $data = $this->addNumber($data, 'NoFeedback', $this->noFeedbackEnum?->value);
        $data = $this->addBool($data, 'NoVersandCalc', $this->noDeliveryCalc);
        $data = $this->addString($data, 'Versandgruppe', $this->shippingGroup);
        $data = $this->addBool($data, 'MwStNichtAusweisen', $this->doNotShowVat);
        $data = $this->addNumber($data, 'MarkierungID', $this->markerId);
        $data = $this->addBool($data, 'NoeBayNameAktu', $this->noEbayName);
        $data = $this->addString($data, 'VID', $this->vid);
        $data = $this->addBool($data, 'CheckVID', $this->checkVid);
        $data = $this->addBool($data, 'CheckPackstation', $this->checkPackStation);
        $data = $this->addBool($data, 'OverrideMarkID', $this->overrideMarkId);

        $data = $this->addString($data, 'SoldCurrency', $this->currencyEnum?->value);
        $data = $this->addBool($data, 'SetPay', $this->payed);
        $data = $this->addDateTime($data, 'SetPayDate', $this->payDate);
        $data = $this->addString($data, 'BillsafeTransactionID', $this->billSafeTransactionId);
        $data = $this->addString($data, 'BillsafeOrderNumber', $this->billSafeOrderNumber);
        $data = $this->addString($data, 'PaymentStatus', $this->paymentStatus);
        $data = $this->addString($data, 'PaymentTransactionID', $this->paymentTransactionId);

        $data = $this->addString($data, 'Bankname', $this->bankName);
        $data = $this->addNumber($data, 'BLZ', $this->blz);
        $data = $this->addNumber($data, 'Kontonummer', $this->bankAccountNumber);
        $data = $this->addString($data, 'Kontoinhaber', $this->bankAccountOwner);
        $data = $this->addString($data, 'BIC', $this->bic);
        return $this->addString($data, 'IBAN', $this->iban);

        /**
         * evtl. einiges noch in eigenständiges Dto auslagern (z.B. Customer, DeliveryAddress, etc.)
         */

        // return $data;
    }
}
