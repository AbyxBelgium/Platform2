<?php

namespace App\Managers;

class WindowsSystemResourceManager extends CommonSystemResourceManager
{
    public function getCPULoad(): int
    {
        exec('wmic cpu get loadpercentage', $cpuLoad);
        return $cpuLoad[1];
    }

    public function getMemoryLoad(): int
    {
        exec('wmic memorychip get capacity', $totalMemory);
        exec('wmic os get freephysicalmemory /format:value', $freeMemory);
        $freeMemory = preg_replace( '/[^0-9]/', '', $freeMemory[2]);
        $total = array_sum($totalMemory);
        return round((($total - ($freeMemory * 1024)) / $total) * 100);
    }
}
