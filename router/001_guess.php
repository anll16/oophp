<?php

namespace Anll16\Guess;

/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));




/**
* Showing message Hello World, rendered within the standard page layout.
 */
$app->router->any(['GET', 'POST'], "guess/play", function () use ($app) {



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

        return $app->response->redirect('guess/play');
    }

//create new game if no game exist in session, this happen when game is loaded directly
    if (!$gameSession) {
        $_SESSION['game'] = new Guess();
        $gameSession = $_SESSION['game'];
    }


    $title = "Hello World as a page";
    $data = [
        "gameSession" => $gameSession,
        "cheat" => $cheat,
    ];

    $app->page->add("anax/v2/guess/guess_my_number", $data);

    if ($gameSession->status() === 'CORRECT' || $gameSession->status() === 'GAME OVER') {
        $app->page->add("anax/v2/guess/game_over");

        // game is over unset session
        unset($_SESSION['game']);
        unset($_SESSION['prevGuess']);
        unset($_SESSION['cheat']);
    }

    return $app->page->render([
        "title" => $title,
    ]);
});
