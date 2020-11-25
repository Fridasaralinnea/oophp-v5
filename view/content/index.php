<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

?><table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>Path</th>
        <th>Slug</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= esc($row->id) ?></td>
        <td><?= esc($row->title) ?></td>
        <td><?= esc($row->type) ?></td>
        <td><?= esc($row->published) ?></td>
        <td><?= esc($row->created) ?></td>
        <td><?= esc($row->updated) ?></td>
        <td><?= esc($row->deleted) ?></td>
        <td><?= esc($row->path) ?></td>
        <td><?= esc($row->slug) ?></td>
    </tr>
<?php endforeach; ?>
</table>
