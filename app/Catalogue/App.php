<?php
/**
 * Every App should expand this class, as it's used by the system for optimal
 * installation and configuration.
 *
 * @author Pieter Verschaffelt
 */

namespace App\Catalogue;


use App\Property;
use App\System\Page\Element;

abstract class App
{
    public abstract function getName(): string;
    public abstract function getElements(): array;

    /**
     * This method should return all routes that are defined by the app.
     * These routes are then accessible from the blade-views defined by this app.
     *
     * @return array
     */
    public function getRoutes(): array
    {
        return [];
    }

    /**
     * This method is called when the app is installed into the system and
     * should be used for registering and installing persistent features, such
     * as database tables.
     */
    public function onInstall(): void {}

    /**
     * This method is called when the app is uninstalled from the system and
     * should be used for deregistering and removing persistent features such
     * as database tables.
     */
    public function onUninstall(): void {}

    public function getElementByIdentifier(string $identifier): Element
    {
        foreach ($this->getElements() as $element) {
            if ($element->getIdentifier() == $identifier) {
                return $element;
            }
        }
        return null;
    }

    public function setProperty(string $key, string $value): void
    {
        $property = new Property();
        $property->app = $this->getName();
        $property->key = $key;
        $property->value = $value;
        $property->save();
    }

    public function getProperty(string $key, string $default): string
    {
        // TODO Fix error handling when property cannot be found!
        $output = Property::where([
            'app' => $this->getName(),
            'key' => $key
        ])->first();

        if ($output) {
            return $output->value;
        } else {
            return $default;
        }
    }
}
