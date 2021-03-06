<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> guesses left.</p>

<form method="post">
    <input type="text" name="newGuess">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>


<?php if ($res) : ?>
    <p><?= $res ?></p>
<?php endif; ?>

<?php if ($number) : ?>
    <p>CHEAT: Current number is <?= $number ?>.</p>
<?php endif; ?>
