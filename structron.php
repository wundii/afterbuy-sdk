<?php

declare(strict_types=1);

use Wundii\Structron\Config\StructronConfig;

return static function (StructronConfig $structronConfig): void {
    $structronConfig->docPath('docs');
    $structronConfig->paths(['src/Dto']);
};