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
<table id="admin-config">
    <tr>
        <th>
            Category
        </th>
        <th>
            Post Count
        </th>
    </tr>
<?php
foreach($categories as $category)
{
    ?>
    <tr>
        <td>
            <?php echo $category->getCategoryName(); ?>
        </td>
        <td>
            <?php echo $category->getEntries()->count(); ?> 
        </td>
    </tr>
<?php
}
?>
</table>
<?php echo form_open('admin/addCategory'); ?>
<table id="admin-config">
    <tr>
        <th colspan="2">
            Add New Category
        </th>
    </tr>
    <tr>
        <td>
            <label for="name">Name</label>
        </td>
        <td>
            <?php echo form_input('name',set_value('name')); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right">
            <input type="submit" name="add" value="Add" class="button" />
        </td>
    </tr>
</table>
<?php echo form_close(); ?>