<?php

namespace Anax\View;

?><form method="post">
    <label for="inputText">Log in</label></br>
    <input type="email" name="email">
    <input type="password" name="password">
    <input type="submit" name="logIn" value="Log in">
</form>

<?php if ($logedIn) : ?>
    <p><?= $logedIn ?></p>
<?php endif; ?>
