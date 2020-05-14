
<h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $guess->tries() ?> guesses left.</p>

<form method="post">
    <input type="text" name="newGuess">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>


<?php if ($doGuess) : ?>
    <p><?= $res ?></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $guess->number() ?>.</p>
<?php endif; ?>
