<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Shipping implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    public function __construct(
        #[Assert\Length(max: 50)]
        public ?string $shippingGroup = null,
        #[Assert\Length(max: 150)]
        public ?string $shippingMethod = null,
        public ?float $shippingCost = null,
        #[Assert\Length(max: 150)]
        public ?string $returnCarrier = null,
        public ?bool $noDeliveryCalc = null,
        public ?bool $checkPackStation = null,
        public ?bool $overrideMarkId = null,
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data, ?int $index = null): array
    {
        $data = $this->addString($data, 'Versandgruppe', $this->shippingGroup);
        $data = $this->addString($data, 'Versandart', $this->shippingMethod);
        $data = $this->addNumber($data, 'Versandkosten', $this->shippingCost);
        $data = $this->addString($data, 'ReturnCarrier', $this->returnCarrier);
        $data = $this->addBool($data, 'NoVersandCalc', $this->noDeliveryCalc);
        $data = $this->addBool($data, 'CheckPackstation', $this->checkPackStation);
        return $this->addBool($data, 'OverrideMarkID', $this->overrideMarkId);
    }
}
