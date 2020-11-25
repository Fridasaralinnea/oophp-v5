<?php

namespace Fla\TextFilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MyTextFilterController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * @var object $textFilter    MyTextFilter object.
     */
    private $textFilter;



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexActionGet() : object
    {
        $title = "Text-filter";
        $page = $this->app->page;

        $page->add("text-filter/index");

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;

        $testroute1 = $request->getPost("testroute1");
        $testroute2 = $request->getPost("testroute2");
        $testroute3 = $request->getPost("testroute3");

        if ($testroute1) {
            return $response->redirect("text-filter/bbcode");
        }

        if ($testroute2) {
            return $response->redirect("text-filter/clickable");
        }

        if ($testroute3) {
            return $response->redirect("text-filter/markdown");
        }

        // return $response->redirect("text-filter/index");
    }


    /**
     * This is the bbcode method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/bbcode
     *
     * @return string
     */
    public function bbcodeActionGet() : object
    {
        $title = "Text-filter";
        $page = $this->app->page;

        $this->textFilter = new MyTextFilter();

        $text = file_get_contents(__DIR__ . "/../../text/bbcode.txt");
        $filter = ["bbcode"];
        $html = $this->textFilter->parse($text, $filter);

        $data = [
            "text" => $text,
            "html" => $html,
        ];

        $page->add("text-filter/bbcode", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the bbcode method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/bbcode
     *
     * @return string
     */
    public function bbcodeActionPost() : object
    {
        $response = $this->app->response;

        return $response->redirect("text-filter/index");
    }


    /**
     * This is the clickable method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/clickable
     *
     * @return string
     */
    public function clickableActionGet() : object
    {
        $title = "Text-filter";
        $page = $this->app->page;

        $this->textFilter = new MyTextFilter();

        $text = file_get_contents(__DIR__ . "/../../text/clickable.txt");
        $filter = ["link"];
        $html = $this->textFilter->parse($text, $filter);

        $data = [
            "text" => $text,
            "html" => $html,
        ];

        $page->add("text-filter/clickable", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the clickable method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/clickable
     *
     * @return string
     */
    public function clickableActionPost() : object
    {
        $response = $this->app->response;

        return $response->redirect("text-filter/index");
    }


    /**
     * This is the markdown method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/markdown
     *
     * @return string
     */
    public function markdownActionGet() : object
    {
        $title = "Text-filter";
        $page = $this->app->page;

        $this->textFilter = new MyTextFilter();

        $text = file_get_contents(__DIR__ . "/../../text/sample.md");
        $filter = ["markdown"];
        $html = $this->textFilter->parse($text, $filter);

        $data = [
            "text" => $text,
            "html" => $html,
        ];

        $page->add("text-filter/markdown", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the markdown method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/markdown
     *
     * @return string
     */
    public function markdownActionPost() : object
    {
        $response = $this->app->response;

        return $response->redirect("text-filter/index");
    }


    /**
     * This is the debug method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/debug
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        // return __METHOD__ . ", \$db is {$this->db}";
        return "Debug!!";
    }
}
