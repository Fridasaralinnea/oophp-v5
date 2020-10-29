<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play game.
 */
$app->router->get("game/init", function () use ($app) {
    // init the session for the gamestart.
    // $doInit = $_POST["doInit"] ?? null;
    //
    // if ($doInit) {
    //     // Unset all of the session variables.
    //     $_SESSION = [];
    //
    //     // If it's desired to kill the session, also delete the session cookie.
    //     // Note: This will destroy the session, and not just the session data!
    //     if (ini_get("session.use_cookies")) {
    //         $params = session_get_cookie_params();
    //         setcookie(
    //             session_name(),
    //             '',
    //             time() - 42000,
    //             $params["path"],
    //             $params["domain"],
    //             $params["secure"],
    //             $params["httponly"]
    //         );
    //     }
    //
    //     // Finally, destroy the session.
    //     session_destroy();
    //     session_name("frls19");
    //     session_start();
    // }

    // if (!isset($_SESSION["guess"])) {
    //     $_SESSION["guess"] = new Fla\Guess\Guess();
    //     $_SESSION["guess"]->random();
    // }

    $_SESSION["game"] = new Fla\Dice\Game();
    // $_SESSION["game"]->random();

    return $app->response->redirect("game/play");
});



/**
 * Play the game . Shoe game status
 */
$app->router->get("game/play", function () use ($app) {
    $title = "Play the 100-game";

    $game = $_SESSION["game"];
    // $doGuess = $_POST["doGuess"] ?? null;
    // $doCheat = $_POST["doCheat"] ?? null;
    // $newGuess = $_POST["newGuess"] ?? null;

    // if ($doGuess) {
    //     $guess->try();
    //     $res = $guess->makeGuess($newGuess);
    // }
    $values = $_SESSION["values"] ?? null;
    $_SESSION["values"] = null;
    $doNotAllowRollOrSave = $_SESSION["doNotAllowRollOrSave"] ?? null;
    $_SESSION["doNotAllowRollOrSave"] = null;
    // $winner = $_SESSION["winner"] ?? null;
    // $_SESSION["winner"] = null;

    $data = [
        "savePoints" => $savePoints ?? null,
        "rollDices" => $rollDices ?? null,
        "doInit" => $doInit ?? null,
        "nextPlayer" => $nextPlayer ?? null,
        "values" => $values,
        "winner" => $game->getWinner(),
        "doNotAllowRollOrSave" => $doNotAllowRollOrSave,
        "pointsPlayer" => $game->getPoints("player"),
        "pointsComputer" => $game->getPoints("computer"),
        "currentPlayer" => $game->getCurrent(),
        "currentPoints" => $game->getSum()
    ];

    $app->page->add("game/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game . Make a guess
 */
$app->router->post("game/play", function () use ($app) {
    $title = "Play the 100-game";

    $game = $_SESSION["game"];
    $rollDices = $_POST["rollDices"] ?? null;
    $savePoints = $_POST["savePoints"] ?? null;
    $nextPlayer = $_POST["nextPlayer"] ?? null;
    $doInit = $_POST["doInit"] ?? null;

    if ($rollDices) {
        $game->throwDices();
        $valuesArray = $game->showThrownDices();
        $valuesString = implode(", ", $valuesArray);
        $_SESSION["values"] = $valuesString;
        $doNotAllow = in_array(1, $valuesArray);
        if ($doNotAllow) {
            $_SESSION["doNotAllowRollOrSave"] = true;
        } else {
            $game->checkIfWinner();
        }
    }

    if ($doInit) {
        return $app->response->redirect("game/init");
    }

    if ($savePoints) {
        $game->savePointsNextPlayer();
        // $_SESSION["number"] = $number;
    }

    if ($nextPlayer) {
        $game->nextPlayer();
        // $_SESSION["number"] = $number;
    }

    return $app->response->redirect("game/play");
});
