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

    private function getPropertyObject(string $key): ?Property
    {
        return Property::where([
            'app' => $this->appName,
            'key' => $key
        ])->first();
    }

    public function setProperty(string $key, string $value): void
    {
        $property = $this->getPropertyObject($key);

        if (!$property) {
            $property = new Property();
        }

        $property->app = $this->appName;
        $property->key = $key;
        $property->value = $value;
        $property->save();
    }

    public function getProperty(string $key, string $default): string
    {
        $output = $this->getPropertyObject($key);

        if ($output) {
            return $output->value;
        } else {
            return $default;
        }
    }
}
