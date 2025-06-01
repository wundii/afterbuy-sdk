<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Response;

use Wundii\AfterbuySdk\Dto\GetListerHistory\ListedItems;
use Wundii\AfterbuySdk\Interface\ResponseDtoInterface;
use Wundii\AfterbuySdk\Interface\ResponseInterface;
use Wundii\AfterbuySdk\Trait\ResponseTrait;

/**
 * @template-implements ResponseInterface<ListedItems>
 */
final class GetListerHistoryResponse implements ResponseInterface
{
    use ResponseTrait;

    /**
     * @return ListedItems
     */
    public function getResult(): ResponseDtoInterface
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
