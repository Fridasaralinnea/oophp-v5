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
    <a href="../movie/search-year">Search year</a> |
    <a href="../movie/crud">Edit or delete</a> |
    <a href="add">add Movie</a>
</navbar>

<p>Add Movie</p>
<form method="post">
    <input type="hidden" name="movieId"/>

    <p>
        <label for="movieTitle">Title:</label><br>
        <input type="text" name="movieTitle"/>
    </p>

    <p>
        <label for="movieYear">Year:</label><br>
        <input type="number" name="movieYear"/>
    </p>

    <p>
        <label for="movieImage">Image: img/</label><br>
        <input type="text" name="movieImage"/>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
    </p>
</form>
