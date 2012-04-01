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
<?php echo form_open('admin/editProfile'); ?>
<?php echo validation_errors('<p class="error">','</p>'); ?>
<?php echo form_hidden('user_id', $user->getUserId()); ?>
<table id="admin-config">
    <tr>
        <th colspan="2">
            Edit Profile
        </th>
    </tr>
    <tr>
        <td>
            Username
        </td>
        <td>
            <?php echo $user->getUserName(); ?>
        </td>
    </tr>
    <tr>
        <td>
            <label for="displayname">Display Name</label>
        </td>
        <td>
            <?php echo form_input('displayname', $user->getUserDisplayName()); ?>
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
            <label for="email">Email Address</label>
        </td>
        <td>
            <?php echo form_input('email',$user->getUserEmail()); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right">
            <input type="submit" name="save" value="Save" class="button" />
        </td>
    </tr>
</table>
<?php echo form_close(); ?>

<script>
    $('input[name="displayname"]').focus();
</script>