<?php
/**
 * Guess my number, POST version.
 */
include(__DIR__ . "/autoload.php");
include(__DIR__ . "/config.php");

// $number = $_POST["number"] ?? null;
// $tries = $_POST["tries"] ?? null;
// $guess = $_POST["guess"] ?? null;




session_name("frls19");
session_start();

$doInit = $_POST["doInit"] ?? null;

if ($doInit) {
    // Unset all of the session variables.
    $_SESSION = [];

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
    session_name("frls19");
    session_start();
}

if (!isset($_SESSION["guess"])) {
    $_SESSION["guess"] = new Guess();
    $_SESSION["guess"]->random();
}

$guess = $_SESSION["guess"];
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;
$newGuess = $_POST["newGuess"] ?? null;


// if ($guess->number() === -1) {
//     $guess->random();
//     // $number = rand(1, 100);
//     // $tries = 5;
//     // header("Location: index_get.php?tries=$tries&number=$number");
// } elseif ($doGuess) {
if ($doGuess) {
    $guess->try();
    $res = $guess->makeGuess($newGuess);
}

// Render page
require __DIR__ . "/view/guess_my_number.php";
