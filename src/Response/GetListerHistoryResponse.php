<?php

declare(strict_types=1);

namespace AfterbuySdk\Response;

use AfterbuySdk\Dto\GetListerHistory\ListedItems;
use AfterbuySdk\Interface\AfterbuyDtoInterface;
use AfterbuySdk\Interface\AfterbuyResponseInterface;
use AfterbuySdk\Trait\AfterbuyResponseTrait;

/**
 * @template-implements AfterbuyResponseInterface<ListedItems>
 */
final class GetListerHistoryResponse implements AfterbuyResponseInterface
{
    use AfterbuyResponseTrait;

    /**
     * @return ListedItems
     */
    public function getResult(): AfterbuyDtoInterface
    {
        $content = $this->content;
        $matches = [];

        preg_match('/<LastHistoryID>(.*)<\/LastHistoryID>/s', $content, $matches);
        $lastHistoryId = $matches[1] ?? null;
        $lastHistoryId = is_numeric($lastHistoryId) ? (int) $lastHistoryId : null;

        $content = (string) preg_replace('/<LastHistoryID>(.*)<\/LastHistoryID>/i', '', $content);

        $listedItems = $this->dataMapper->xml($content, ListedItems::class, ['Result'], true);
        $listedItems->setLastHistoryId($lastHistoryId);

        return $listedItems;
    }
}
