<?php
/*
 * Copyright 2012 Andrew Landsverk
 *
 * This file is part of Quantify.
 *
 * Quantify is free software: you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software 
 * Foundation, either version 3 of the License, or (at your option) any later 
 * version.
 *
 * Quantify is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more 
 * details.
 *
 * You should have received a copy of the GNU General Public License along with 
 * Quantify. If not, see http://www.gnu.org/licenses/.
 */
?>
<script>
    function doConfirm(entry)
    {
        if(confirm("Are you sure you want to delete " + entry + "?"))
            return true;
        else
            return false;
    }
</script>
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
            <?php echo anchor('story/view/'.$entry['entry_id'], '[V]'); ?>
        </td>
        <td>
            <a href="entry/deleteEntry/<?php echo $entry['entry_id']; ?>" onClick="return doConfirm('<?php echo $entry['entry_title']; ?>');">[D]</a>
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