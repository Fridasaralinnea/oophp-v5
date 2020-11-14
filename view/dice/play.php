<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Först till 100 (1)</h1>

<p>Först till hundra vinner.</p>

<form method="post">
    <input type="submit" name="doInit" value="Start new game">
</form>

<p>Points player: <?= $pointsPlayer ?>  Points computer: <?= $pointsComputer ?></p>

<?php if ($winner) : ?>
    <p><?= $winner ?> has won!!!!!!!!!!</p>
<?php else : ?>
    <p>Current player: <?= $currentPlayer ?></p>
    <p>Current points: <?= $currentPoints ?></p>

    <?php if ($doNotAllowRollOrSave) : ?>
        <form method="post">
            <input type="submit" name="nextPlayer" value="Next Player">
        </form>
    <?php else : ?>
        <form method="post">
            <input type="submit" name="rollDices" value="Roll dices">
            <input type="submit" name="savePoints" value="Save points">
        </form>
    <?php endif; ?>

    <?php if ($values) : ?>
        <p><?= $values ?></p>
    <?php endif; ?>

<?php endif; ?>

<p>Histogram: </br><?= $printHistogram ?></p>
