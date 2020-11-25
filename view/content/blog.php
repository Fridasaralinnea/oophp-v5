<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

?><article>

<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
<section>
    <header>
        <h1><a href="<?= url("content/blogpost/$row->slug") ?>"><?= esc($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
    </header>
    <?= $row->data ?>
</section>
<?php endforeach; ?>

</article>
