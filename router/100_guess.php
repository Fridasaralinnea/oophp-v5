<?php
/**
 * Init the game and redirect to play game.
 */
$app->router->get("guess/init", function () use ($app) {
    $_SESSION["guess"] = new Fla\Guess\Guess();
    $_SESSION["guess"]->random();

    return $app->response->redirect("guess/play");
});

/**
 * Play the game . Shoe game status
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    $guess = $_SESSION["guess"];
    $res = $_SESSION["res"] ?? null;
    $_SESSION["res"] = null;
    $number = $_SESSION["number"] ?? null;
    $_SESSION["number"] = null;

    $data = [
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
        "doInit" => $doInit ?? null,
        "res" => $res,
        "tries" => $guess->tries(),
        "number" => $number
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game . Make a guess
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game";

    $guess = $_SESSION["guess"];
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;
    $newGuess = $_POST["newGuess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;

    if ($doGuess) {
        $guess->try();
        $res = $guess->makeGuess($newGuess);
        $_SESSION["res"] = $res;
    }

    if ($doInit) {
        return $app->response->redirect("guess/init");
    }

    if ($doCheat) {
        $number = $guess->number();
        $_SESSION["number"] = $number;
    }

    return $app->response->redirect("guess/play");
});
