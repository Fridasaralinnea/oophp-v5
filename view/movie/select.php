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
    <a href="<?= url("movie/select") ?>">SELECT *</a> |
    <a href="<?= url("movie") ?>">Show all movies</a> |
    <a href="<?= url("movie/reset") ?>">Reset database</a> |
    <a href="<?= url("movie/search-title") ?>">Search title</a> |
    <a href="<?= url("movie/search-year") ?>">Search year</a> |
    <a href="<?= url("movie/crud") ?>">Edit or delete</a> |
    <a href="<?= url("movie/add") ?>">add Movie</a>
</navbar>

<pre>
<?= print_r($resultset, true) ?>
</pre>
