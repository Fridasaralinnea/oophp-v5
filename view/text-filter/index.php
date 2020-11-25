<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>TextFilter</h1>

<form method="post">
    <label>Choose testroute:</label></br>
    <input type="submit" name="testroute1" value="Testroute bbcode"></br>
    <input type="submit" name="testroute2" value="Testroute clickable"></br>
    <input type="submit" name="testroute3" value="Testroute markdown">
</form>
