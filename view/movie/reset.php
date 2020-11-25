<?php

namespace Anax\View;

/**
 * Render content for movie.
 */

// // Restore the database to its original settings
// $file   = "sql/setup.sql";
// $mysql  = "/usr/bin/mysql";
// $output = null;
//
// // Extract hostname and databasename from dsn
// $dsnDetail = [];
// preg_match("/mysql:host=(.+);dbname=([^;.]+)/", $databaseConfig["dsn"], $dsnDetail);
// $host = $dsnDetail[1];
// $database = $dsnDetail[2];
// $login = $databaseConfig["login"];
// $password = $databaseConfig["password"];
//
// if (isset($_POST["reset"]) || isset($_GET["reset"])) {
//     $command = "$mysql -h{$host} -u{$login} -p{$password} $database < $file 2>&1";
//     $output = [];
//     $status = null;
//     $res = exec($command, $output, $status);
//     $output = "<p>The command was: <code>$command</code>.<br>The command exit status was $status."
//         . "<br>The output from the command was:</p><pre>"
//         . print_r($output, 1);
// }
//

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

<p>
    <form method="post">
        <input type="submit" name="reset" value="Reset database">
    </form>
</p>

<?php if ($resetDone) : ?>
    <p>Database has sucsesfully been reset.</p>
<?php endif; ?>
