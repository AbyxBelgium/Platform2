<?php
/**
 * @author Pieter Verschaffelt
 */


namespace App\System\Data;


use App\Property;

class PropertyHandler
{
    private $appName;

    public function __construct(string $appName)
    {
        $this->appName = $appName;
    }

    public function setProperty(string $key, string $value): void
    {
        $property = new Property();
        $property->app = $this->appName;
        $property->key = $key;
        $property->value = $value;
        $property->save();
    }

    public function getProperty(string $key, string $default): string
    {
        $output = Property::where([
            'app' => $this->appName,
            'key' => $key
        ])->first();

        if ($output) {
            return $output->value;
        } else {
            return $default;
        }
    }
}
