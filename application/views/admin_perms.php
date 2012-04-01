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
            Permission
        </th>
        <th>
            Level
        </th>
     <!--   <th>
            
        </th> -->
    </tr>
<?php
foreach($permissions as $permission)
{
    ?>
    <tr>
        <td>
            <?php echo $permission->getPermissionName(); ?>
        </td>
        <td>
            <?php echo $permission->getPermissionLevel(); ?>
        </td>
       <!-- <td>
            <?php //echo anchor('admin/deleteUser/' . $permission->getPermissionId(), '[D]'); ?>
        </td> -->
    </tr>
<?php
}
?>
</table>
<?php //echo form_open('admin/addPermission'); ?>
<?php //echo validation_errors('<p class="error">','</p>'); ?>
<!--
<table id="admin-config">
    <tr>
        <th colspan="2">
            Add New Permisison
        </th>
    </tr>
    <tr>
        <td>
            <label for="permname">Permission Name</label>
        </td>
        <td>
            <?php //echo form_input('permname',set_value('permname')); ?>
        </td>
    </tr>
    <tr>
        <td>
            <label for="permlevel">Permission Level</label>
        </td>
        <td>
            <?php //echo form_input('permlevel',set_value('permlevel')); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right">
            <input type="submit" name="add" value="Add" class="button" />
        </td>
    </tr>
</table>
-->
<?php //echo form_close(); ?>