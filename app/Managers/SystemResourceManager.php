<?php

namespace App\Managers;


interface SystemResourceManager
{
    /**
     * Returns the current CPU load as a percentage.
     *
     * @return float
     */
    public function getCPULoad(): int;

    /**
     * Returns the current memory load as a percentage.
     *
     * @return float
     */
    public function getMemoryLoad(): int;

    /**
     * Returns the current storage usage as a percentage.
     *
     * @return float
     */
    public function getStorageUsage(): int;
}
