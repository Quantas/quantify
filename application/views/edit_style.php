<script src="<?php echo site_url(); ?>resources/codemirror/lib/codemirror.js"></script>
<link rel="stylesheet" href="<?php echo site_url(); ?>resources/codemirror/lib/codemirror.css">
<script src="<?php echo site_url(); ?>resources/codemirror/mode/css/css.js"></script>

<?php echo form_open('theme/edit'); ?>
<div class="style-editor">
    <textarea cols="70" rows="25" name="newtheme" id="newtheme" tabindex="1"><?php echo $content ?></textarea>
    <script type="text/javascript">
        var myCodeMirror = CodeMirror.fromTextArea(newtheme, {lineNumbers: true, smartIndent: true, matchBrackets: true});
    </script>
</div>
<div class="style-editor-buttons">
    <input type="submit" name="submit" value="Submit" class="button" />
</div>
<?php echo form_close(); ?>