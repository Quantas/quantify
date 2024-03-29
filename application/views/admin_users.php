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
    function doConfirm(user)
    {
        if(confirm("Are you sure you want to delete " + user + "?"))
            return true;
        else
            return false;
    }
</script>
<table id="admin-config">
    <tr>
        <th>
            Username
        </th>
        <th>
            Display Name
        </th>
        <th>
            Permission
        </th>
        <th>
            Entries
        </th>
        <th>
            
        </th>
    </tr>
<?php
foreach($users as $user)
{
    ?>
    <tr>
        <td>
            <?php echo $user->getUserName(); ?>
        </td>
        <td>
            <?php echo $user->getUserDisplayName(); ?>
        </td>
        <td>
            <?php echo $user->getPermission()->getPermissionName(); ?>
        </td>
        <td>
            <?php 
                try 
                {
                    echo $user->getEntries()->count(); 
                }
                catch(Exception $e) //This is dirty
                {
                    echo '0';
                }
            ?> 
        </td>
        <td>
            <a href="deleteUser/<?php echo $user->getUserId(); ?>" onClick="return doConfirm('<?php echo $user->getUserName(); ?>');">[D]</a> <?php echo anchor('admin/editUser/' . $user->getUserId(), '[E]'); ?>
        </td>
    </tr>
<?php
}
?>
</table>
<?php echo form_open('admin/addUser'); ?>
<?php echo validation_errors('<p class="error">','</p>'); ?>
<table id="admin-config">
    <tr>
        <th colspan="2">
            Add New User
        </th>
    </tr>
    <tr>
        <td>
            <label for="username">Username</label>
        </td>
        <td>
            <?php echo form_input('username',set_value('username')); ?>
        </td>
    </tr>
    <tr>
        <td>
            <label for="displayname">Display Name</label>
        </td>
        <td>
            <?php echo form_input('displayname',set_value('displayname')); ?>
        </td>
    </tr>
    <tr>
        <td>
            <label for="password">Password</label>
        </td>
        <td>
            <?php echo form_password('password',set_value('password')); ?>
        </td>
    </tr>
    <tr>
        <td>
            <label for="password-again">Password Again</label>
        </td>
        <td>
            <?php echo form_password('password-again',set_value('password-again')); ?>
        </td>
    </tr>
    <tr>
        <td>
            <label for="permission">Permission</label>
        </td>
        <td>
            <select id="category" name="permission">
            <?php
                foreach($permissions as $permission)
                {
                    echo '<option value="' . $permission->getPermissionId() . '">' . $permission->getPermissionName() . '</option>';
                }
            ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <label for="email">Email Address</label>
        </td>
        <td>
            <?php echo form_input('email',set_value('email')); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right">
            <input type="submit" name="add" value="Add" class="button" />
        </td>
    </tr>
</table>
<?php echo form_close(); ?>
<script>
    $('input[name="username"]').focus();
</script>