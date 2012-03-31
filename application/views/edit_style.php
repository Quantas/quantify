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
    <input type="button" name="cancel" value="Cancel" class="button" onClick="history.go(-1)" />
</div>
<?php echo form_close(); ?>