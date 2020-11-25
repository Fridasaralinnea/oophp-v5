<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

?><table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>Actions</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= esc($row->id) ?></td>
        <td><?= esc($row->title) ?></td>
        <td><?= esc($row->type) ?></td>
        <td><?= esc($row->published) ?></td>
        <td><?= esc($row->created) ?></td>
        <td><?= esc($row->updated) ?></td>
        <td><?= esc($row->deleted) ?></td>
        <td>
            <a class="icons" href="<?= url("content/edit/$row->id") ?>" title="Edit this content">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </a>
            <a class="icons" href="<?= url("content/delete/$row->id") ?>" title="Delete this content">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
