<?php

namespace Anax\View;

?><p>
    <form method="post">
        <input type="submit" name="reset" value="Reset database">
    </form>
</p>

<?php if ($resetDone) : ?>
    <p>Database has sucsesfully been reset.</p>
<?php endif; ?>
