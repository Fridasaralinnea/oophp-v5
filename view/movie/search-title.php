<?php

namespace Anax\View;

/**
 * Render content for movie.
 */


?><h1>Movie</h1>

<navbar class="navbar">
    <a href="<?= url("movie/select") ?>">SELECT *</a> |
    <a href="<?= url("movie") ?>">Show all movies</a> |
    <a href="<?= url("movie/reset") ?>">Reset database</a> |
    <a href="<?= url("movie/search-title") ?>">Search title</a> |
    <a href="<?= url("movie/search-year") ?>">Search year</a> |
    <a href="<?= url("movie/crud") ?>">Edit or delete</a> |
    <a href="<?= url("movie/add") ?>">add Movie</a>
</navbar>

<p>Search Movies by title</p>
<form method="post">
    <input type="hidden" name="route" value="search-title">
    <label for="searchTitle">Title (use % as wildcard):</label>
    <input type="search" name="searchTitle"/>
    <input type="submit" name="doSearch" value="Search">
    <input type="submit" name="getAll" value="Show all">
</form>

<?php if ($resultset) : ?>
<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
    <?php $id = -1; foreach ($resultset as $row) :
        $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="../<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>
