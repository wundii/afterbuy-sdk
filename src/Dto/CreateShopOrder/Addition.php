<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\CreateShopOrder;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Interface\RequestDtoArrayInterface;
use Wundii\AfterbuySdk\Trait\ShopApiTrait;

final readonly class Addition implements RequestDtoArrayInterface
{
    use ShopApiTrait;

    public function __construct(
        #[Assert\Length(max: 255)]
        public ?string $comment = null,
        #[Assert\Length(max: 255)]
        public ?string $memo = null,
        public ?bool $useComplWeight = null,
        public ?bool $useProductTaxRate = null,
        #[Assert\Length(max: 255)]
        public ?string $orderInfo1 = null,
        #[Assert\Length(max: 255)]
        public ?string $orderInfo2 = null,
        #[Assert\Length(max: 255)]
        public ?string $orderInfo3 = null,
        public ?int $markerId = null,
        public ?bool $noEbayName = null,
        #[Assert\Length(max: 40)]
        public ?string $vid = null,
        public ?bool $checkVid = null,
    ) {
    }

    /**
     * @param   array<string,string> $data
     * @return  array<string,string>
     */
    public function toArray(array $data, ?int $index = null): array
    {
        $data = $this->addString($data, 'Kommentar', $this->comment);
        $data = $this->addString($data, 'VMemo', $this->memo);
        $data = $this->addBool($data, 'UseComplWeight', $this->useComplWeight);
        $data = $this->addBool($data, 'UseProductTaxRate', $this->useProductTaxRate);
        $data = $this->addString($data, 'OrderInfo1', $this->orderInfo1);
        $data = $this->addString($data, 'OrderInfo2', $this->orderInfo2);
        $data = $this->addString($data, 'OrderInfo3', $this->orderInfo3);
        $data = $this->addNumber($data, 'MarkierungID', $this->markerId);
        $data = $this->addBool($data, 'NoeBayNameAktu', $this->noEbayName);
        $data = $this->addString($data, 'VID', $this->vid);
        return $this->addBool($data, 'CheckVID', $this->checkVid);
    }
}
