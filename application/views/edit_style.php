<?php echo form_open('theme/edit'); ?>
<textarea cols="70" rows="25" name="newtheme" id="newtheme" tabindex="1"><?php echo $content ?></textarea>
<?php
    echo form_submit('Submit', 'Submit');
    echo form_close();
    ?>