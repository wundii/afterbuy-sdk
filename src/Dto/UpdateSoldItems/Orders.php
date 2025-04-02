<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateSoldItems;

use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;
use Exception;
use InvalidArgumentException;

final class Orders implements AfterbuyAppendXmlContentInterface
{
    private string $invalidMessage = 'Is valid was not called';

    /**
     * @param Order[] $orders
     */
    public function __construct(
        private readonly array $orders = [],
    ) {
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    public function isValid(): bool
    {
        $deepOrder = function (Order $order) use (&$orderCount): void {
            ++$orderCount;
            if ($orderCount > 150) {
                throw new Exception('Orders can not contain more than 150 catalogs');
            }

            $parcelLabelNumber = [];
            foreach ($order->getShippingInfo()?->getParcelLabels() ?? [] as $parcelLabel) {
                if (
                    isset($parcelLabelNumber[$parcelLabel->getPackageNumber()])
                    && $parcelLabelNumber[$parcelLabel->getPackageNumber()] !== $parcelLabel->getParcelLabelNumber()
                ) {
                    throw new InvalidArgumentException('Parcel label number must be unique in order');
                }

                if (
                    ! isset($parcelLabelNumber[$parcelLabel->getPackageNumber()])
                    && $parcelLabel->getParcelLabelNumber() !== null
                ) {
                    $parcelLabelNumber[$parcelLabel->getPackageNumber()] = $parcelLabel->getParcelLabelNumber();
                }
            }
        };

        try {
            $orderCount = 0;
            foreach ($this->orders as $order) {
                $deepOrder($order);
            }
        } catch (Exception $exception) {
            $this->invalidMessage = $exception->getMessage();

            return false;
        }

        return true;
    }

    public function getInvalidMessage(): string
    {
        return $this->invalidMessage;
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $orders = $xml->addChild('Orders');

        foreach ($this->orders as $order) {
            $order->appendXmlContent($orders);
        }
    }
}
