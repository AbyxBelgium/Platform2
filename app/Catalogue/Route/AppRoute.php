<?php


namespace App\Catalogue;


abstract class AppRoute
{
    private $path;
    private $executor;
    private $name;

    /**
     * @param string $path Route to be mapped upon.
     * @param string $executor Controller and method that are responsible for executing this Route.
     * @param string $name Name by which Route can be referenced from other components.
     */
    public function __construct(string $path, string $executor, string $name)
    {
        $this->path = $path;
        $this->executor = $executor;
        $this->name = str_replace("/", "_", $name);
        DebugBar::addMessage($this->name);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getExecutor(): string
    {
        return $this->executor;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public abstract function getType(): string;
}
