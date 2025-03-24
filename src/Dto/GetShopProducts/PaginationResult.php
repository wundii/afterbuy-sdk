<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\GetShopProducts;

use AfterbuySdk\Interface\AfterbuyDtoInterface;

final class PaginationResult implements AfterbuyDtoInterface
{
    public function __construct(
        private int $totalNumberOfEntries,
        private int $totalNumberOfPages,
        private int $itemsPerPage,
        private int $pageNumber,
    ) {
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function setItemsPerPage(int $itemsPerPage): void
    {
        $this->itemsPerPage = $itemsPerPage;
    }

    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber): void
    {
        $this->pageNumber = $pageNumber;
    }

    public function getTotalNumberOfEntries(): int
    {
        return $this->totalNumberOfEntries;
    }

    public function setTotalNumberOfEntries(int $totalNumberOfEntries): void
    {
        $this->totalNumberOfEntries = $totalNumberOfEntries;
    }

    public function getTotalNumberOfPages(): int
    {
        return $this->totalNumberOfPages;
    }

    public function setTotalNumberOfPages(int $totalNumberOfPages): void
    {
        $this->totalNumberOfPages = $totalNumberOfPages;
    }
}
