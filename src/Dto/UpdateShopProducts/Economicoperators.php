<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\UpdateActionEconomicoperatorsEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\AfterbuyRequestDtoInterface;

final readonly class Economicoperators implements AfterbuyRequestDtoInterface
{
    /**
     * @param int[] $economicoperatorId
     */
    public function __construct(
        private UpdateActionEconomicoperatorsEnum $updateActionEconomicoperatorsEnum,
        private array $economicoperatorId,
    ) {
        if ($this->economicoperatorId === []) {
            throw new InvalidArgumentException('EconomicoperatorId must not be empty');
        }
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $economicoperators = $xml->addChild('Economicoperators');
        $economicoperators->addNumber('UpdateAction', $this->updateActionEconomicoperatorsEnum->value);
        foreach ($this->economicoperatorId as $economicoperatorId) {
            $economicoperators->addNumber('EconomicoperatorId', $economicoperatorId);
        }
    }

    /**
     * @return int[]
     */
    #[Assert\Count(min: 1)]
    #[Assert\All(new Assert\Type('int'))]
    public function getEconomicoperatorId(): array
    {
        return $this->economicoperatorId;
    }

    public function getUpdateAction(): UpdateActionEconomicoperatorsEnum
    {
        return $this->updateActionEconomicoperatorsEnum;
    }
}
