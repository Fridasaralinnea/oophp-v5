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
    <a href="select">SELECT *</a> |
    <a href="../movie">Show all movies</a> |
    <a href="../movie/reset">Reset database</a> |
    <a href="../movie/search-title">Search title</a> |
    <a href="../movie/search-year">Search year</a> |
    <a href="../movie/crud">Edit or delete</a> |
    <a href="../movie/add">add Movie</a>
</navbar>

<pre>
<?= print_r($resultset, true) ?>
</pre>
