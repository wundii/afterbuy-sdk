<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Enum;

enum DefaultFilterSoldItemsEnum: string
{
    case COMPLETEDAUCTIONS = 'CompletedAuctions';
    case INVOICEPRINTED = 'InvoicePrinted';
    case NEWAUCTIONS = 'NewAuctions';
    case NOXMLDATE = 'NoXmlDate';
    case PAIDAUCTIONS = 'PaidAuctions';
    case READYTOSHIP = 'ReadyToShip';
    case NOT_COMPLETEDAUCTIONS = 'Not_CompletedAuctions';
    case NOT_INVOICEPRINTED = 'Not_InvoicePrinted';
    case NOT_NEWAUCTIONS = 'Not_NewAuctions';
    case NOT_NOXMLDATE = 'Not_NoXmlDate';
    case NOT_PAIDAUCTIONS = 'Not_PaidAuctions';
    case NOT_READYTOSHIP = 'Not_ReadyToShip';
}
