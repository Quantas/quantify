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
    </table>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/wysiwyg.image.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/wysiwyg.table.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/wysiwyg.link.js"></script>
    <link rel="stylesheet" href="<?php echo site_url(); ?>resources/jwysiwyg/jquery.wysiwyg.css" />
    <script type="text/javascript">
        $(function() 
        {
            $('#wysiwyg').wysiwyg();
            <?php if (!isset($entry)) { ?>$('#wysiwyg').wysiwyg('clear');<?php } ?>
        });
    </script>
    <textarea id="wysiwyg" name="wysiwyg" style="width: 100%">
        <?php if(isset($entry)) echo $entry->getEntryContent(); ?>
    </textarea>
    <input type="submit" name="Submit" value="Submit" class="button" />
    <?php echo form_close(); ?>
</div>