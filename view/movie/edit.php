<?php

namespace Anax\View;

/**
 * Render content for movie.
 */

if (!$movie) {
    return;
}

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

<p>Edit Movie</p>
<form method="post">
    <input type="hidden" name="movieId" value="<?= $movie->id ?>"/>

    <p>
        <label for="movieTitle">Title:</label><br>
        <input type="text" name="movieTitle"/>
    </p>

    <p>
        <label for="movieYear">Year:</label><br>
        <input type="number" name="movieYear"/>
    </p>

    <p>
        <label for="movieImage">Image:</label><br>
        <input type="text" name="movieImage"/>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
    </p>
</form>
