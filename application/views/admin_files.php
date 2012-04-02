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
            Filename
        </th>
        <th>
            
        </th>
    </tr>
<?php
foreach($files as $file)
{
    ?>
    <tr>
        <td>
            <?php echo $file; ?>
        </td>
        <td>
            <?php echo anchor('admin/deleteFile/' . $file, '[D]'); ?> 
        </td>
    </tr>
<?php
}
?>
</table>
<?php echo form_open_multipart('admin/uploadFile'); ?>
<table id="admin-config">
    <tr>
        <th colspan="2">
            Upload new file
        </th>
    </tr>
    <tr>
        <td>
            <label for="userfile">File</label>
        </td>
        <td>
            <?php echo form_upload('userfile'); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right">
            <input type="submit" name="upload" value="Upload" class="button" />
        </td>
    </tr>
</table>
<?php echo form_close(); ?>

<script>
    $('input[name="name"]').focus();
</script>