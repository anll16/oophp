<?php

namespace Anax\View;

?>

<h1>Guess my number</h1>
<p>Guess a number between 1 and 100. You have <?php echo $data['gameSession']->tries(); ?> tries left.</p>


<form method="post">
    <input type="number" name="guess">
    <input type="submit" name="makeGuess" value="Guess">
    <input type="submit" name="showAnswer" value="Cheat">
    <input type="submit" name="restart" value="Restart">

</form>
<?php if ($data['gameSession']->status() !== null) : ?>
    <p>You guessed: <?php echo $data['gameSession']->prevGuess(); ?> and its <?php echo $data['gameSession']->status(); ?></p>
<?php endif; ?>

<?php if ($data['cheat']) : ?>
    <p>The answer is: <?php echo $data['cheat'] ?></p>
<?php endif; ?>
