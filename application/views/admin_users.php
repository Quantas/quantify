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
            <?php echo $user->getEntries()->count(); ?> 
        </td>
    </tr>
<?php
}
?>
</table>
<?php echo form_open('admin/addUser'); ?>
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
            <?php echo form_input('password',set_value('password')); ?>
        </td>
    </tr>
    <tr>
        <td>
            <label for="password-again">Password Again</label>
        </td>
        <td>
            <?php echo form_input('password-again',set_value('password-again')); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right">
            <input type="submit" name="add" value="Add" class="button" />
        </td>
    </tr>
</table>
<?php echo form_close(); ?>