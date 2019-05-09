<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 2019-05-06
 * Time: 23:35
 */

include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");
session_start();


$number = $_POST['number'] ?? null;
$tries = $_POST['tries'] ?? null;
$guess = $_POST['guess'] ?? null;
$restart = $_POST['restart'] ?? null;
$makeGuess = $_POST['makeGuess'] ?? null;
$showAnswer = $_POST['showAnswer'] ?? null;
$gameSession = $_SESSION['game'] ?? null;
$prevGuess = $_SESSION['prevGuess'] ?? null;
$cheat = $_SESSION['cheat'] ?? null;

if ($_POST) {
    if ($guess && $makeGuess && $gameSession) {
        $gameSession->makeGuess((int)$guess);
    }

    if ($showAnswer) {
        $_SESSION['cheat'] = $gameSession->number();
    }

    if ($restart) {
        $_SESSION['game'] = new Guess();
    }

    header('Location: index.php');
    die();
}

//create new game if no game exist in session, this happen when game is loaded directly
if (!$gameSession) {
    $_SESSION['game'] = new Guess();
    $gameSession = $_SESSION['game'];
}

require __DIR__ . '/view/guess_my_number.php';

if ($gameSession->status() === 'CORRECT' || $gameSession->status() === 'GAME OVER') {
    echo '<h3>Game is over, press any button to start again</h3>';

    // game is over unset session
    unset($_SESSION['game']);
    unset($_SESSION['prevGuess']);
    unset($_SESSION['cheat']);
}
