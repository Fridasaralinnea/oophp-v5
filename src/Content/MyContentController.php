<?php

namespace Fla\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Fla\TextFilter\MyTextFilter;

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
class MyContentController implements AppInjectableInterface
{
    use AppInjectableTrait;
    use MyContentTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";
    private $textFilter;



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->textFilter = new MyTextFilter();

        // Use $this->app to access the framework services.
    }



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
        $title = "Content";
        $page = $this->app->page;

        $res = $this->getAll();

        $page->add("content/navigation");
        $page->add("content/index", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the pages method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/pages
     *
     * @return string
     */
    public function pagesActionGet() : object
    {
        $title = "Content";
        $page = $this->app->page;

        $res = $this->getPages();

        foreach ($res as $row) {
            $filterArray = explode(",", $row->filter);
            $row->data = $this->textFilter->parse(esc($row->data), $filterArray);
        }

        $page->add("content/navigation");
        $page->add("content/pages", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the page method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/page
     *
     * @return string
     */
    public function pageActionGet() : object
    {
        $route = getGet("path");
        $title = "Content";
        $page = $this->app->page;
        $response = $this->app->response;

        $res = $this->getPage($route);

        if (!$res) {
            return $response->redirect("content/pageNotFound");
        }

        $filterArray = explode(",", $res->filter);
        $res->data = $this->textFilter->parse(esc($res->data), $filterArray);

        $page->add("content/navigation");
        $page->add("content/page", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }



    // /**
    //  * This is the page method action, it handles:
    //  * ANY METHOD mountpoint
    //  * ANY METHOD mountpoint/
    //  * ANY METHOD mountpoint/page
    //  *
    //  * @return string
    //  */
    // public function pageActionGet() : object
    // {
    //     return $response->redirect("content/pageNotFound");
    // }



    /**
     * This is the blog method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/blog
     *
     * @return string
     */
    public function blogActionGet() : object
    {
        $title = "Content";
        $page = $this->app->page;

        $res = $this->getPosts();

        foreach ($res as $row) {
            $filterArray = explode(",", $row->filter);
            $row->data = $this->textFilter->parse(esc($row->data), $filterArray);
        }

        $page->add("content/navigation");
        $page->add("content/blog", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the page method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/page
     *
     * @return string
     */
    public function blogpostActionGet($slug) : object
    {
        $title = "Content";
        $page = $this->app->page;
        $response = $this->app->response;

        $res = $this->getPost($slug);

        if (!$res) {
            return $response->redirect("content/pageNotFound");
        }

        if (count($res) > 1) {
            return $response->redirect("content/twoSlugs");
        }

        $res = $res[0];
        $text = "";

        if ($res->filter) {
            $filterArray = explode(",", $res->filter);
            $text = $this->textFilter->parse(esc($res->data), $filterArray);
        }

        if (!$res->filter && $res->data) {
            $text = esc($res->data);
        }

        $page->add("content/navigation");
        $page->add("content/blogpost", [
            "resultset" => $res,
            "text" => $text,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the reset method action GET, it handles:
     * ANY METHOD mountpoint/select
     *
     * @return object
     */
    public function resetActionGet() : object
    {
        $title = "Content";
        $page = $this->app->page;

        $resetDone = $this->getSetSession("resetDone");

        $data = [
            "resetDone" => $resetDone,
        ];

        $page->add("content/navigation");
        $page->add("content/reset", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the reset method action POST, it handles:
     * ANY METHOD mountpoint/select
     *
     * @return object
     */
    public function resetActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        $reset = $request->getPost("reset");

        if ($reset) {
            $this->resetContent();
            $session->set("resetDone", true);
        }

        return $response->redirect("content/reset");
    }



    /**
     * This is the admin method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/admin
     *
     * @return string
     */
    public function adminActionGet() : object
    {
        $title = "Content";
        $page = $this->app->page;

        $res = $this->getAll();

        $page->add("content/navigation");
        $page->add("content/admin", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the edit method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/edit
     *
     * @return string
     */
    public function editActionGet($id) : object
    {
        $title = "Content";
        $page = $this->app->page;

        $res = $this->getById($id);

        $page->add("content/navigation");
        $page->add("content/edit", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the edit method action POST, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/edit
     *
     * @return string
     */
    public function editActionPost($id) : object
    {
        $request = $this->app->request;
        $response = $this->app->response;

        $doDelete = $request->getPost("doDelete");
        $doSave = $request->getPost("doSave");
        $contentId = $id;
        $contentTitle = $request->getPost("contentTitle");
        $contentPath = $request->getPost("contentPath");
        $contentSlug = $request->getPost("contentSlug");
        $contentData = $request->getPost("contentData");
        $contentType = $request->getPost("contentType");
        $contentFilter = $request->getPost("contentFilter");
        $contentPublish = $request->getPost("contentPublish");

        if (!$contentSlug) {
            $contentSlug = slugify($contentTitle);
        }

        if (!$contentPath) {
            $contentPath = null;
        }

        if ($doSave) {
            $this->editById($contentId, $contentTitle, $contentPath, $contentSlug, $contentData, $contentType, $contentFilter, $contentPublish);
        }

        if ($doDelete) {
            $this->deleteById($contentId);
        }

        return $response->redirect("content/admin");
    }



    /**
     * This is the delete method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/delete
     *
     * @return string
     */
    public function deleteActionGet($id) : object
    {
        $title = "Content";
        $page = $this->app->page;

        $res = $this->getById($id);

        $page->add("content/navigation");
        $page->add("content/delete", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the delete method action POST, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/delete
     *
     * @return string
     */
    public function deleteActionPost($id) : object
    {
        $request = $this->app->request;
        $response = $this->app->response;

        $doDelete = $request->getPost("doDelete");
        $contentId = $id;

        if ($doDelete) {
            $this->deleteById($contentId);
        }

        return $response->redirect("content/admin");
    }



    /**
     * This is the create method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/create
     *
     * @return string
     */
    public function createActionGet() : object
    {
        $title = "Content";
        $page = $this->app->page;

        $page->add("content/navigation");
        $page->add("content/create");

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the create method action POST, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/create
     *
     * @return string
     */
    public function createActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;

        $doCreate = $request->getPost("doCreate");
        $contentTitle = $request->getPost("contentTitle");

        if ($doCreate) {
            $id = $this->createContent($contentTitle);
        }

        return $response->redirect("content/edit/$id");
    }



    /**
     * This is the log-in method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/log-in
     *
     * @return string
     */
    public function logInActionGet() : object
    {
        $title = "Content";
        $page = $this->app->page;
        $session = $this->app->session;

        $logedIn = $session->get("logedIn");
        $session->set("logedIn", null);

        $data = [
            "logedIn" => $logedIn,
        ];

        $page->add("content/navigation");
        $page->add("content/log-in", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the log-in method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/log-in
     *
     * @return string
     */
    public function logInActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        $logIn = $request->getPost("logIn");
        $email = $request->getPost("email");

        if ($logIn) {
            $session->set("logedIn", "$email loged in.");
        }

        return $response->redirect("content/log-in");
    }


    /**
     * This is the pageNotFound method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/pageNotFound
     *
     * @return string
     */
    public function pageNotFoundActionGet() : object
    {
        $title = "Content";
        $page = $this->app->page;

        $page->add("content/navigation");
        $page->add("content/404");

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the twoSlugs method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/twoSlugs
     *
     * @return string
     */
    public function twoSlugsActionGet() : object
    {
        $title = "Content";
        $page = $this->app->page;

        $page->add("content/navigation");
        $page->add("content/slug-handler");

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
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
        return "Debug my game!!";
    }
}
