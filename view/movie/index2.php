<?php

namespace Anax\View;

/**
 * Render content for movie.
 */

if (!$resultset) {
    return;
}

$defaultRoute = "?";
$max = count($resultset);

?><h1>Movie</h1>

<navbar class="navbar">
    <a href="movie/select">SELECT *</a> |
    <a href="movie">Show all movies</a> |
    <!-- <a href="movie/reset">Reset database</a> | -->
    <a href="movie/search-title">Search title</a> |
    <a href="movie/search-year">Search year</a> |
    <a href="movie/crud">Edit or delete</a> |
    <a href="movie/add">add Movie</a>
</navbar>

<p>Items per page:
    <a href="<?= mergeQueryString(["hits" => 2], $defaultRoute) ?>">2</a> |
    <a href="<?= mergeQueryString(["hits" => 4], $defaultRoute) ?>">4</a> |
    <a href="<?= mergeQueryString(["hits" => 8], $defaultRoute) ?>">8</a>
</p>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id <?= orderby2("id", $defaultRoute) ?></th>
        <th>Bild <?= orderby2("image", $defaultRoute) ?></th>
        <th>Titel <?= orderby2("title", $defaultRoute) ?></th>
        <th>År <?= orderby2("year", $defaultRoute) ?></th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>

<p>
    Pages:
    <?php for ($i = 1; $i <= $max; $i++) : ?>
        <a href="<?= mergeQueryString(["page" => $i], $defaultRoute) ?>"><?= $i ?></a>
    <?php endfor; ?>
</p>
