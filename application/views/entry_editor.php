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
<div class="entry_editor_wrapper">
    <?php 
        if(isset($entry))
        {
            echo form_open('entry/editEntry');
            echo form_hidden('entry_id', $entry->getEntryId());
        }
        else
        {
            echo form_open('entry/submit');
        }
    ?>
    <table>
        <tr>
            <td>Entry Title</td>
            <td><?php
                    if(isset($entry))
                    {
                        $entryValue = $entry->getEntryTitle();
                    }
                    else
                    {
                        $entryValue = '';
                    }
                    echo form_input('entryTitle', $entryValue); 
                ?>
            </td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <select id="category" name="category">
                <?php
                foreach ($categories as $category)
                {
                    if(isset($entry) && $entry->getCategory()->getCategoryName() == $category->getCategoryName())
                    {
                        echo '<option value="' . $category->getCategoryName() . '" SELECTED>' . $category->getCategoryName() . '</option>';
                    }
                    else
                    {
                        echo '<option value="' . $category->getCategoryName() . '">' . $category->getCategoryName() . '</option>';
                    }
                }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Commenting Enabled</td>
            <td>
                <input type="checkbox" name="commenting" <?php if(isset($entry) && $entry->getEntryCommentsEnabled() == 1){ echo 'CHECKED'; } ?>/>
            </td>
        </tr>
        <tr>
            <td>Add Image</td>
            <td>
                <select id="images" name="images">
                <?php
                echo '<option value="" SELECTED></option>';
                
                foreach ($files as $file)
                {
                    echo '<option value="' . $file . '">' . $file . '</option>';
                }
                ?>
                </select>
                <input id="addImage" class="button" type="button" name="addImage" value="Add Image" onClick="javascript:appendImage(); " />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input id="richButton" class="button" type="button" name="type" value="Plain Editor" onClick="javascript:toggleEditor(); " />
            </td>
        </tr>
    </table>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/wysiwyg.image.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/wysiwyg.table.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/wysiwyg.link.js"></script>
    <link rel="stylesheet" href="<?php echo site_url(); ?>resources/jwysiwyg/jquery.wysiwyg.css" />
    <script type="text/javascript">
        var isRich = true;
        
        $(function() 
        {
            $('#wysiwyg').wysiwyg({
                controls: {
                    insertImage: { visible : false }
                }
            });
            <?php if (!isset($entry)) { ?>$('#wysiwyg').wysiwyg('clear');<?php } ?>
        });
        
        function toggleEditor()
        {
            if(isRich)
            {
                $('#wysiwyg').wysiwyg('destroy');
                isRich = false;
                $('#richButton').val('Rich Editor');
            }
            else
            {
                $('#wysiwyg').wysiwyg({
                controls: {
                    insertImage: { visible : false }
                }
                });
                isRich = true;
                $('#richButton').val('Plain Editor');
            }
        }
        
        function appendImage()
        {
            var selectedImage = $("#images").val();
            var baseUrl = '<?php echo base_url(); ?>';
            var imageUrl = baseUrl + 'assets/uploads/' + selectedImage;
            
            $('#wysiwyg').wysiwyg('destroy');
            $('#wysiwyg').val($('#wysiwyg').val() + '<a href="'+imageUrl+'" rel="lytebox[image]"><img style="width: 100%;" src="' + imageUrl + '" /></a>');
            $('#wysiwyg').wysiwyg({
                controls: {
                    insertImage: { visible : false }
                }
                });
        }
    </script>
    <textarea id="wysiwyg" name="wysiwyg" style="width: 100%; height:400px">
        <?php if(isset($entry)) echo $entry->getEntryContent(); ?>
    </textarea>
    <input type="submit" name="Submit" value="Submit" class="button" />
    <?php echo form_close(); ?>     
</div>

<script>
    $('input[name="entryTitle"]').focus();
</script>