<?php
/**
 * @author Pieter Verschaffelt
 */

namespace App\System\Page;


use App\Catalogue\App;
use App\Managers\AppManager;
use App\System\UI\ExtensionForm;
use App\System\UI\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Element
{
    private $executor;
    private $identifier;
    private $app;
    private $backendContent;
    private $uuid;

    /**
     * Construct a new Element.
     *
     * @param string $identifier A value that's unique amongst all different types of elements provided by an App, but
     *        that's identical for all instantiations of this particular type of element.
     * @param string $executor String in the format "Controller@methodName" that's responsible for rendering this
     *        element's frontend content.
     * @param App $app The App-instantiation from which this element was instantiated.
     * @param ExtensionForm|null $backendContent Form that displays all possible values and configuration parameters
     *        that can be set for this element. This form is used as an input for configuring this element by the user.
     */
    public function __construct(string $identifier, string $executor, App $app, ?ExtensionForm $backendContent = null)
    {
        $this->identifier = $identifier;
        $this->executor = $executor;
        $this->app = $app;
        $this->backendContent = $backendContent;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function render($request, string $uuid)
    {
        $appManager = new AppManager();
        return $appManager->invokeControllerFunction($this->app, $this->executor, $request, $this->app, $uuid);
    }

    public function getApp(): App
    {
        return $this->app;
    }

    public function getBackendContent()
    {
        return $this->backendContent;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;
    }
}
