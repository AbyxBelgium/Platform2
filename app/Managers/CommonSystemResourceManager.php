<?php

namespace App\Managers;


abstract class CommonSystemResourceManager implements SystemResourceManager
{
    private function convertBytesToMegaBytes(float $bytes): int
    {
        return round($bytes / (1024 * 1024));
    }

    public function getStorageUsage(): int
    {
        return 100 - round(($this->convertBytesToMegaBytes(disk_free_space("../")) / $this->convertBytesToMegaBytes(disk_total_space("../"))) * 100);
    }
}
