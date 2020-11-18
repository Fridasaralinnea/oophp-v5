<?php

namespace Anax\View;

/**
 * Render content for movie.
 */


?><h1>Movie</h1>

<navbar class="navbar">
    <a href="../movie/select">SELECT *</a> |
    <a href="../movie">Show all movies</a> |
    <a href="../movie/reset">Reset database</a> |
    <a href="../movie/search-title">Search title</a> |
    <a href="search-year">Search year</a> |
    <a href="../movie/crud">Edit or delete</a> |
    <a href="../movie/add">add Movie</a>
</navbar>


<p>Search Movies by year from 1900 - 2100</p>
<form method="post">
    <input type="hidden" name="route" value="search-year">
    <p>
        <label>Created between:
        <input type="number" name="year1" min="1900" max="2100" />
        -
        <input type="number" name="year2" min="1900" max="2100"/>
        </label>
    </p>
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
