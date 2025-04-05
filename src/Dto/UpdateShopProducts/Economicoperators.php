<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Enum\UpdateActionEconomicoperatorsEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use InvalidArgumentException;

final readonly class Economicoperators implements AfterbuyAppendXmlContentInterface
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
    public function getEconomicoperatorId(): array
    {
        return $this->economicoperatorId;
    }

    public function getUpdateAction(): UpdateActionEconomicoperatorsEnum
    {
        return $this->updateActionEconomicoperatorsEnum;
    }
}
