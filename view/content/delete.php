<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

?><form method="post">
    <fieldset>
    <legend>Delete</legend>

    <input type="hidden" name="contentId" value="<?= esc($resultset->id) ?>"/>

    <p>
        <label>Title:<br>
            <input type="text" name="contentTitle" value="<?= esc($resultset->title) ?>" readonly/>
        </label>
    </p>

    <p>
        <!-- <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> -->
        <input type="submit" name="doDelete" value="Delete"/>
    </p>
    </fieldset>
</form>
