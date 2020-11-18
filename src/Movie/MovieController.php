<?php

namespace Fla\Movie;

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
class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;
    use MovieTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



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
    public function indexAction() : object
    {
        $title = "Movie database | oophp";
        $page = $this->app->page;

        $res = $this->getAll();

        $page->add("movie/index", [
            "resultset" => $res,
        ]);

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
        return "Debug movie!!";
    }



    /**
     * This is the select method action, it handles:
     * ANY METHOD mountpoint/select
     *
     * @return object
     */
    public function selectAction() : object
    {
        $title = "Movie database | oophp";
        $page = $this->app->page;

        $res = $this->getAll();

        $page->add("movie/select", [
            "resultset" => $res,
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
        $title = "Movie database | oophp";
        $page = $this->app->page;

        $resetDone = $this->getSetSession("resetDone");

        $data = [
            "resetDone" => $resetDone,
        ];

        $page->add("movie/reset", $data);

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
            $this->resetMovie();
            $session->set("resetDone", true);
        }

        return $response->redirect("movie/reset");
    }


    /**
     * This is the search method action GET, it handles:
     * ANY METHOD mountpoint/select
     *
     * @return object
     */
    public function searchTitleActionGet() : object
    {
        $title = "Movie database | oophp";
        $page = $this->app->page;

        $resultset = $this->getSetSession("resultset");

        $data = [
            "resultset" => $resultset,
        ];

        $page->add("movie/search-title", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the searchTitlePost method action, it handles:
     * ANY METHOD mountpoint/movie/search-title
     *
     * @return object
     */
    public function searchTitleActionPost() : object
    {
        // $title = "Play the 100-game";
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        $getAll = $request->getPost("getAll");
        $doSearch = $request->getPost("doSearch");
        $searchTitle = $request->getPost("searchTitle");

        if ($getAll) {
            $res = $this->getAll();

            $session->set("resultset", $res);
        }

        if ($doSearch) {
            $res = $this->searchTitle($searchTitle);

            $session->set("resultset", $res);
        }

        return $response->redirect("movie/search-title");
    }



    /**
     * This is the search method action GET, it handles:
     * ANY METHOD mountpoint/select
     *
     * @return object
     */
    public function searchYearActionGet() : object
    {
        $title = "Movie database | oophp";
        $page = $this->app->page;

        $resultset = $this->getSetSession("resultset");

        $data = [
            "resultset" => $resultset,
        ];

        $page->add("movie/search-year", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the searchTitlePost method action, it handles:
     * ANY METHOD mountpoint/movie/search-title
     *
     * @return object
     */
    public function searchYearActionPost() : object
    {
        // $title = "Play the 100-game";
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        $getAll = $request->getPost("getAll");
        $doSearch = $request->getPost("doSearch");
        $year1 = $request->getPost("year1");
        $year2 = $request->getPost("year2");

        if ($getAll) {
            $res = $this->getAll();

            $session->set("resultset", $res);
        }

        if ($doSearch) {
            $res = $this->searchYear($year1, $year2);

            $session->set("resultset", $res);
        }

        return $response->redirect("movie/search-year");
    }


    /**
     * This is the crudGet method action, it handles:
     * ANY METHOD mountpoint/movie/crud
     *
     * @return string
     */
    public function crudActionGet() : object
    {
        $title = "Movie database | oophp";
        $page = $this->app->page;

        $res = $this->getAll();

        $page->add("movie/crud", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the crudPost method action, it handles:
     * ANY METHOD mountpoint/movie/crud
     *
     * @return object
     */
    public function crudActionPost() : object
    {
        // $title = "Play the 100-game";
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        $doEdit = $request->getPost("doEdit");
        $doDelete = $request->getPost("doDelete");
        $movieId = $request->getPost("movieId");

        if ($doEdit) {
            $session->set("movieId", $movieId);

            return $response->redirect("movie/edit");
        }

        if ($doDelete) {
            $this->deleteMovie($movieId);

            return $response->redirect("movie/index");
        }
    }

    /**
     * This is the editGet method action, it handles:
     * ANY METHOD mountpoint/movie/edit
     *
     * @return string
     */
    public function editActionGet() : object
    {
        $title = "Movie database | oophp";
        $page = $this->app->page;

        $movieId = $this->getSetSession("movieId");

        $movie = $this->getMovie($movieId);

        $page->add("movie/edit", [
            "movie" => $movie,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is the editPost method action, it handles:
     * ANY METHOD mountpoint/movie/edit
     *
     * @return object
     */
    public function editActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;

        $doSave = $request->getPost("doSave");
        $movieId = $request->getPost("movieId");
        $movieTitle = $request->getPost("movieTitle");
        $movieImage = $request->getPost("movieImage");
        $movieYear = $request->getPost("movieYear");

        if ($doSave) {
            $this->updateMovie($movieId, $movieTitle, $movieImage, $movieYear);

            return $response->redirect("movie/index");
        }
    }


    /**
     * This is the addGet method action, it handles:
     * ANY METHOD mountpoint/movie/add
     *
     * @return string
     */
    public function addActionGet() : object
    {
        $title = "Movie database | oophp";
        $page = $this->app->page;

        $page->add("movie/add");

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the addPost method action, it handles:
     * ANY METHOD mountpoint/movie/add
     *
     * @return object
     */
    public function addActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;

        $doSave = $request->getPost("doSave");
        $movieTitle = $request->getPost("movieTitle");
        $movieImage = $request->getPost("movieImage");
        $movieYear = $request->getPost("movieYear");

        $image = "img/";
        $image .= $movieImage;

        if ($doSave) {
            $this->addMovie($movieTitle, $image, $movieYear);

            return $response->redirect("movie/index");
        }
    }


    //
    // /**
    //  * This is the reset method action POST, it handles:
    //  * ANY METHOD mountpoint/select
    //  *
    //  * @return object
    //  */
    // public function resetActionPost() : object
    // {
    //     $title = "Movie database | oophp";
    //     $page = $this->app->page;
    //     $request = $this->app->request;
    //     $response = $this->app->response;
    //     $session = $this->app->session;
    //     $db = $this->app->db;
    //
    //
    //     // Restore the database to its original settings
    //     $file   = "../../sql/setup.sql";
    //     $mysql  = "/usr/bin/mysql";
    //     $output = null;
    //
    //     // Extract hostname and databasename from dsn
    //     $dsnDetail = [];
    //     preg_match("/mysql:host=(.+);dbname=([^;.]+)/", $databaseConfig["dsn"], $dsnDetail);
    //     $host = $dsnDetail[1];
    //     $database = $dsnDetail[2];
    //     $login = $databaseConfig["login"];
    //     $password = $databaseConfig["password"];
    //
    //     if ($reset) {
    //         $command = "$mysql -h{$host} -u{$login} -p{$password} $database < $file 2>&1";
    //         $output = [];
    //         $status = null;
    //         $res = exec($command, $output, $status);
    //     }
    //
    //     $page->add("movie/reset", []);
    //
    //     return $page->render([
    //         "title" => $title,
    //     ]);
    //
    //     return $response->redirect("movie/reset");
    // }

    //
    // /**
    //  * This is the play method action, it handles:
    //  * ANY METHOD mountpoint/dice/play
    //  *
    //  * @return object
    //  */
    // public function playActionGet() : object
    // {
    //     $title = "Först till 100 (1)";
    //     $page = $this->app->page;
    //     $session = $this->app->session;
    //
    //     // $game = $_SESSION["game"];
    //     // $values = $_SESSION["values"] ?? null;
    //     // $_SESSION["values"] = null;
    //     // $doNotAllowRollOrSave = $_SESSION["doNotAllowRollOrSave"] ?? null;
    //     // $_SESSION["doNotAllowRollOrSave"] = null;
    //     $game = $session->get("game");
    //     $values = $session->get("values");
    //     $session->set("values", null);
    //     $doNotAllowRollOrSave = $session->get("doNotAllowRollOrSave");
    //     $session->set("doNotAllowRollOrSave", null);
    //
    //     $data = [
    //         // "savePoints" => $savePoints ?? null,
    //         // "rollDices" => $rollDices ?? null,
    //         // "doInit" => $doInit ?? null,
    //         // "nextPlayer" => $nextPlayer ?? null,
    //         "values" => $values,
    //         "winner" => $game->getWinner(),
    //         "doNotAllowRollOrSave" => $doNotAllowRollOrSave,
    //         "pointsPlayer" => $game->getPoints("player"),
    //         "pointsComputer" => $game->getPoints("computer"),
    //         "currentPlayer" => $game->getCurrent(),
    //         "currentPoints" => $game->getSum(),
    //         // "serie" => $game->getHistogramSerieAsString(),
    //         "printHistogram" => $game->printHistogram()
    //     ];
    //
    //     $page->add("dice/play", $data);
    //     // $page->add("game/debug");
    //
    //     return $page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    //
    //
    // /**
    //  * This is the playPost method action, it handles:
    //  * ANY METHOD mountpoint/dice/play
    //  *
    //  * @return object
    //  */
    // public function playActionPost() : object
    // {
    //     // $title = "Play the 100-game";
    //     $request = $this->app->request;
    //     $response = $this->app->response;
    //     $session = $this->app->session;
    //
    //     // $game = $_SESSION["game"];
    //     $game = $session->get("game");
    //
    //     // $rollDices = $_POST["rollDices"] ?? null;
    //     // $savePoints = $_POST["savePoints"] ?? null;
    //     // $nextPlayer = $_POST["nextPlayer"] ?? null;
    //     // $doInit = $_POST["doInit"] ?? null;
    //     $rollDices = $request->getPost("rollDices");
    //     $savePoints = $request->getPost("savePoints");
    //     $nextPlayer = $request->getPost("nextPlayer");
    //     $doInit = $request->getPost("doInit");
    //
    //     if ($rollDices) {
    //         $game->throwDices();
    //         $valuesArray = $game->showThrownDices();
    //         $valuesString = implode(", ", $valuesArray);
    //         // $_SESSION["values"] = $valuesString;
    //         $session->set("values", $valuesString);
    //         $doNotAllow = in_array(1, $valuesArray);
    //         if ($doNotAllow) {
    //             // $_SESSION["doNotAllowRollOrSave"] = true;
    //             $session->set("doNotAllowRollOrSave", true);
    //         } else {
    //             $game->checkIfWinner();
    //         }
    //     }
    //
    //     if ($doInit) {
    //         return $response->redirect("dice/init");
    //     }
    //
    //     if ($savePoints) {
    //         $game->savePointsNextPlayer();
    //     }
    //
    //     if ($nextPlayer) {
    //         $game->nextPlayer();
    //     }
    //
    //     return $response->redirect("dice/play");
    // }
}
