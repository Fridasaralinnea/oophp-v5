<?php
/**
 * Init the game and redirect to play game.
 */
$app->router->get("game/init", function () use ($app) {
    $_SESSION["game"] = new Fla\Dice\Game();

    return $app->response->redirect("game/play");
});

/**
 * Play the game . Shoe game status
 */
$app->router->get("game/play", function () use ($app) {
    $title = "Play the 100-game";

    $game = $_SESSION["game"];
    $values = $_SESSION["values"] ?? null;
    $_SESSION["values"] = null;
    $doNotAllowRollOrSave = $_SESSION["doNotAllowRollOrSave"] ?? null;
    $_SESSION["doNotAllowRollOrSave"] = null;

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
    // $app->page->add("game/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game .
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
    }

    if ($nextPlayer) {
        $game->nextPlayer();
    }

    return $app->response->redirect("game/play");
});
