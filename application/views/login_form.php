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
<?php echo form_open('/auth/submit'); ?>

<?php echo validation_errors('<p class="error">','</p>'); ?>
<table>
<tr>
        <td><label for="username">Username </label></td>
        <td><?php echo form_input('username',set_value('username')); ?></td>
</tr>
<tr>
        <td><label for="password">Password </label></td>
        <td><?php echo form_password('password'); ?></td>
</tr>
<tr>
    <td colspan="2"><input type="submit" id="submit" name="submit" value="Login" class="button"></td>
</tr>
</table>
<?php echo form_close(); ?>

<script>
    $('input[name="username"]').focus();
</script>