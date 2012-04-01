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

echo form_open('register/addUser'); ?>
<?php echo validation_errors('<p class="error">','</p>'); ?>
<table id="admin-config">
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
            <label for="email">Email Address</label>
        </td>
        <td>
            <?php echo form_input('email',set_value('email')); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right">
            <input type="submit" name="add" value="Sign Up" class="button" />
        </td>
    </tr>
</table>
<?php echo form_close(); ?>