<table id="admin-config">
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
            <?php echo anchor('entry/edit/'.$entry['entry_id'], '[E]'); ?>
        </td>
        <td>
            <?php echo anchor('entry/view/'.$entry['entry_id'], '[V]'); ?>
        </td>
        <td>
            <?php echo anchor('entry/deleteEntry/'.$entry['entry_id'], '[D]'); ?>
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

<input type="button" name="add" value="Add" class="button" onclick="javascript:window.location = '<?php echo site_url(); ?>entry/add';" />