<?php
/**
 * Every App should expand this class, as it's used by the system for optimal
 * installation and configuration.
 *
 * @author Pieter Verschaffelt
 */

namespace App\Catalogue;


use App\System\Page\Element;

abstract class App
{
    public abstract function getName(): string;
    public abstract function getElements(): array;

    /**
     * This method is called when the App is installed into the system and
     * should be used for registering and installing persistent features, such
     * as database tables.
     */
    public function onInstall(): void {}

    /**
     * This method is called when the App is uninstalled from the system and
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
}
