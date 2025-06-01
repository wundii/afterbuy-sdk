<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Order implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    /**
     * @param Product[] $products
     */
    public function __construct(
        #[Assert\Valid]
        public Customer $customer,
        #[Assert\Valid]
        public ?DeliveryAddress $deliveryAddress = null,
        #[Assert\Count(min: 1, max: 5)]
        #[Assert\Valid]
        public array $products = [],
        public ?bool $dealer = null,
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data, ?int $index = null): array
    {
        /**
         * PosAnz
         */

        $data = $this->addObject($data, $this->customer);
        $data = $this->addObject($data, $this->deliveryAddress);
        $data = $this->addBool($data, 'Haendler', $this->dealer);
        $data = $this->addNumber($data, 'PosAnz', count($this->products));

        foreach ($this->products as $index => $product) {
            $data = $this->addObject($data, $product, $index);
        }

        return $data;
    }
}
