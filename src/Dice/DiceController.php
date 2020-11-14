<?php

namespace Fla\Dice;

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
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



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
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        // return __METHOD__ . ", \$db is {$this->db}";
        return "INDEX!!";
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



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/init
     *
     * @return object
     */
    public function initAction() : object
    {
        $response = $this->app->response;
        $session = $this->app->session;

        // $_SESSION["game"] = new Game();
        $session->set("game", new Game());

        return $response->redirect("dice/play");
    }



    /**
     * This is the play method action, it handles:
     * ANY METHOD mountpoint/dice/play
     *
     * @return object
     */
    public function playActionGet() : object
    {
        $title = "Först till 100 (1)";
        $page = $this->app->page;
        $session = $this->app->session;

        // $game = $_SESSION["game"];
        // $values = $_SESSION["values"] ?? null;
        // $_SESSION["values"] = null;
        // $doNotAllowRollOrSave = $_SESSION["doNotAllowRollOrSave"] ?? null;
        // $_SESSION["doNotAllowRollOrSave"] = null;
        $game = $session->get("game");
        $values = $session->get("values");
        $session->set("values", null);
        $doNotAllowRollOrSave = $session->get("doNotAllowRollOrSave");
        $session->set("doNotAllowRollOrSave", null);

        $data = [
            // "savePoints" => $savePoints ?? null,
            // "rollDices" => $rollDices ?? null,
            // "doInit" => $doInit ?? null,
            // "nextPlayer" => $nextPlayer ?? null,
            "values" => $values,
            "winner" => $game->getWinner(),
            "doNotAllowRollOrSave" => $doNotAllowRollOrSave,
            "pointsPlayer" => $game->getPoints("player"),
            "pointsComputer" => $game->getPoints("computer"),
            "currentPlayer" => $game->getCurrent(),
            "currentPoints" => $game->getSum(),
            // "serie" => $game->getHistogramSerieAsString(),
            "printHistogram" => $game->printHistogram()
        ];

        $page->add("dice/play", $data);
        // $page->add("game/debug");

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the playPost method action, it handles:
     * ANY METHOD mountpoint/dice/play
     *
     * @return object
     */
    public function playActionPost() : object
    {
        // $title = "Play the 100-game";
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        // $game = $_SESSION["game"];
        $game = $session->get("game");

        // $rollDices = $_POST["rollDices"] ?? null;
        // $savePoints = $_POST["savePoints"] ?? null;
        // $nextPlayer = $_POST["nextPlayer"] ?? null;
        // $doInit = $_POST["doInit"] ?? null;
        $rollDices = $request->getPost("rollDices");
        $savePoints = $request->getPost("savePoints");
        $nextPlayer = $request->getPost("nextPlayer");
        $doInit = $request->getPost("doInit");

        if ($rollDices) {
            $game->throwDices();
            $valuesArray = $game->showThrownDices();
            $valuesString = implode(", ", $valuesArray);
            // $_SESSION["values"] = $valuesString;
            $session->set("values", $valuesString);
            $doNotAllow = in_array(1, $valuesArray);
            if ($doNotAllow) {
                // $_SESSION["doNotAllowRollOrSave"] = true;
                $session->set("doNotAllowRollOrSave", true);
            } else {
                $game->checkIfWinner();
            }
        }

        if ($doInit) {
            return $response->redirect("dice/init");
        }

        if ($savePoints) {
            $game->savePointsNextPlayer();
        }

        if ($nextPlayer) {
            $game->nextPlayer();
        }

        return $response->redirect("dice/play");
    }
}
