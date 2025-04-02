<?php

declare(strict_types=1);

namespace AfterbuySdk\Tests\MockClasses;

use Psr\Log\AbstractLogger;
use Stringable;

final class MockLogger extends AbstractLogger
{
    private array $logger = [];

    public function log($level, string|Stringable $message, array $context = []): void
    {
        $this->logger[(string) $level][] = [
            'message' => (string) $message,
            'context' => $context,
        ];
    }

    public function getLogger(): array
    {
        return $this->logger;
    }

    public function getLoggerByLevel(string $level): array
    {
        return $this->logger[$level] ?? [];
    }
}
