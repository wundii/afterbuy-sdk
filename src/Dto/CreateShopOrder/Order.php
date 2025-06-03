<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\CurrencyEnum;
use Wundii\AfterbuySdk\Enum\CustomerIdentificationEnum;
use Wundii\AfterbuySdk\Enum\NoFeedbackEnum;
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
        #[Assert\Length(max: 50)]
        public string $reference,
        public CurrencyEnum $currencyEnum,
        public bool $doNotShowVat,
        public NoFeedbackEnum $noFeedbackEnum,
        #[Assert\Valid]
        public Customer $customer,
        #[Assert\Valid]
        public ?DeliveryAddress $deliveryAddress = null,
        #[Assert\Count(min: 1, max: 5)]
        #[Assert\Valid]
        public array $products = [],
        public ?Shipping $shipping = null,
        public ?Payment $payment = null,
        public ?Addition $addition = null,
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
        $data = $this->addString($data, 'reference', $this->reference);
        $data = $this->addString($data, 'SoldCurrency', $this->currencyEnum->value);
        $data = $this->addBool($data, 'MwStNichtAusweisen', $this->doNotShowVat);
        $data = $this->addNumber($data, 'NoFeedback', $this->noFeedbackEnum->value);
        $data = $this->addObject($data, $this->customer);
        $data = $this->addObject($data, $this->deliveryAddress);

        $data = $this->addNumber($data, 'PosAnz', count($this->products));
        foreach ($this->products as $index => $product) {
            $data = $this->addObject($data, $product, $index);
        }

        $data = $this->addObject($data, $this->shipping);
        $data = $this->addObject($data, $this->payment);
        return $this->addObject($data, $this->addition);
    }
}
