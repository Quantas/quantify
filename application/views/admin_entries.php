<table id="admin-config" style="width:750px">
    <tr>
        <th>
            Entry
        </th>
        <th></th>
        <th></th>
        <th></th>
        <th>
            Author
        </th>
        <th>
            Category
        </th>
        <th>
            Posted At
        </th>
    </tr>
<?php
foreach($entries as $entry)
{   
    ?>
    <tr>
        <td>
            <?php echo $entry['entry_title']; ?>
        </td>
        <td>
            <?php echo anchor('admin/editEntry/'.$entry['entry_id'], '[EDIT]'); ?>
        </td>
        <td>
            <?php echo anchor('entry/view/'.$entry['entry_id'], '[VIEW]'); ?>
        </td>
        <td>
            <?php echo anchor('admin/deleteEntry/'.$entry['entry_id'], '[DELETE]'); ?>
        </td>
        <td>
            <?php echo $entry['user_display_name']; ?>
        </td>
        <td>
            <?php echo $entry['category_name']; ?>
        </td>
        <td>
            <?php echo $entry['entry_timestamp']; ?>
        </td>
    </tr>
<?php
}
?>
</table>
<?php if (isset($pagination)): ?>
    <div class="pagination">
        Pages: <?php echo $pagination; ?>
    </div>
<?php endif; ?>