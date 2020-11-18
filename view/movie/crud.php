<?php

namespace Anax\View;

/**
 * Render content for movie.
 */
if (!$resultset) {
    return;
}


?><h1>Movie</h1>

<navbar class="navbar">
    <a href="../movie/select">SELECT *</a> |
    <a href="../movie">Show all movies</a> |
    <a href="../movie/reset">Reset database</a> |
    <a href="../movie/search-title">Search title</a> |
    <a href="../movie/search-year">Search year</a> |
    <a href="crud">Edit or delete</a> |
    <a href="../movie/add">add Movie</a>
</navbar>

<p>Choose a movie to edit or delete</p>

<form method="post">
    <label for="movieId">Movie</label>
    <select name="movieId">
        <option value="">Select movie...</option>
        <?php foreach ($resultset as $row) : ?>
        <option value="<?= $row->id ?>"><?= $row->title ?></option>
        <?php endforeach; ?>
    </select>

    <p>
        <input type="submit" name="doEdit" value="Edit">
        <input type="submit" name="doDelete" value="Delete">
    </p>
</form>
