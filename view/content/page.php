<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

?><article>
    <header>
        <h1><?= esc($resultset->title) ?></h1>
        <p><i>Created: <?= esc($resultset->created) ?></i></p>
        <?php if ($resultset->updated) : ?>
        <p><i>Latest update: <?= esc($resultset->updated) ?></i></p>
        <?php endif; ?>
    </header>
    <?= $resultset->data ?>
</article>
