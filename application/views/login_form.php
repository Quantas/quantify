<?php echo form_open('auth/submit'); ?>

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