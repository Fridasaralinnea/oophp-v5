<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play game.
 */
$app->router->get("guess/init", function () use ($app) {
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
    // $doGuess = $_POST["doGuess"] ?? null;
    // $doCheat = $_POST["doCheat"] ?? null;
    // $newGuess = $_POST["newGuess"] ?? null;

    // if ($doGuess) {
    //     $guess->try();
    //     $res = $guess->makeGuess($newGuess);
    // }
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
