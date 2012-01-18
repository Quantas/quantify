<?php
foreach($entries as $entry)
{   
    ?>
    <div id="entries-entry">
        <div id="entries-title">
            <?php echo anchor('entry/view/' . $entry['entry_id'], $entry['entry_title']); ?>
        </div>
        <div id="entries-subtitle">
            By: <?php echo $entry['user_display_name']; ?> | Posted in: <?php echo $entry['category_name']; ?> | At: <?php echo $entry['entry_timestamp']; ?>
        </div>
        <div id="entries-text">
            <?php
                echo substr($entry['content'],0, 250); 
                if(strlen($entry['content']) > 250)
                {
                    echo '...';
                }
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