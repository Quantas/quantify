<div class="entry_editor_wrapper">
    <?php echo form_open('entry/submit');
        echo 'Entry Title' . form_input('entryTitle');
    ?>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/wysiwyg.image.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/wysiwyg.table.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>resources/jwysiwyg/wysiwyg.link.js"></script>
    <link rel="stylesheet" href="<?php echo site_url(); ?>resources/jwysiwyg/jquery.wysiwyg.css" />
    <script type="text/javascript">
        $(function() 
        {
            $('#wysiwyg').wysiwyg();
            $('#wysiwyg').wysiwyg('clear');
        });
    </script>
    <textarea id="wysiwyg" name="wysiwyg" style="width: 700px;"></textarea>
    <input type="submit" name="Submit" value="Submit" class="style-button" />
    <?php echo form_close(); ?>
</div>