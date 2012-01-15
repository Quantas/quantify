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