<?php

namespace Anax\View;

// use Michelf\MarkdownExtra;
//
// // Include essentials
// require __DIR__ . "/../src/config.php";
// require __DIR__ . "/../vendor/autoload.php";
//
// /**
//  * Helper, Markdown formatting converting to HTML.
//  *
//  * @param string text The text to be converted.
//  *
//  * @return string the formatted text.
//  *
//  * @SuppressWarnings(PHPMD.StaticAccess)
//  */
// function markdown($text)
// {
//     return MarkdownExtra::defaultTransform($text);
// }
//
// $text = file_get_contents(__DIR__ . "/../text/sample.md");
// $html = markdown($text);


?><h1>TextFilter</h1>

<form method="post">
    <input type="submit" name="back" value="Back to TextFilter">
</form>

<h2>Showing off Markdown</h2>

<h2>Markdown source in sample.md</h2>
<pre><?= $text ?></pre>

<h2>Text formatted as HTML source</h2>
<pre><?= htmlentities($html) ?></pre>

<h2>Text displayed as HTML</h2>
<?= $html ?>
