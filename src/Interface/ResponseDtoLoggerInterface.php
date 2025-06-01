<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Interface;

interface ResponseDtoLoggerInterface extends ResponseDtoInterface
{
    public function getMessage(): string;
}
