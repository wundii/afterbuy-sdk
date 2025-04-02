<?php

declare(strict_types=1);

use Wundii\PHPLint\Config\LintConfig;

return static function (LintConfig $lintConfig): void {
    $lintConfig->paths([
        'src',
        'tests',
    ]);
};