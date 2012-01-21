<script src="<?php echo site_url(); ?>resources/codemirror/lib/codemirror.js"></script>
<link rel="stylesheet" href="<?php echo site_url(); ?>resources/codemirror/lib/codemirror.css">
<script src="<?php echo site_url(); ?>resources/codemirror/mode/css/css.js"></script>

<div class="editor">
    <?php echo form_open('theme/edit'); ?>
    <textarea cols="70" rows="25" name="newtheme" id="newtheme" tabindex="1"><?php echo $content ?></textarea>
    <?php
        echo form_submit('Submit', 'Submit');
        echo form_close();
        ?>
    <script type="text/javascript">
        var myCodeMirror = CodeMirror.fromTextArea(newtheme, {lineNumbers: true, smartIndent: true, matchBrackets: true});
    </script>
</div>