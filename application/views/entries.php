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
<?php
foreach($entries as $entry)
{   
    ?>
    <div id="entries-entry">
        <div id="entries-title">
            <?php echo anchor('story/view/' . $entry['entry_id'], $entry['entry_title']); ?>
        </div>
        <div id="entries-subtitle">
            By: <?php echo $entry['user_display_name']; ?> | Posted in: <?php echo $entry['category_name']; ?> | At: <?php echo $entry['entry_timestamp']; ?>
        </div>
        <div id="entries-text">
            <?php
                echo $entry['content'];
            ?>
        </div>
    </div>
<?php
}
?>

<?php if (isset($pagination)): ?>
    <div class="pagination">
        <?php echo $pagination; ?>
    </div>
<?php endif; ?>