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
<script type="text/javascript">
    $(document).ready(function() {
        $('#disqus').hide();
   });
</script>

<div id="entry_main">
    <div id="entry_head">
        <?php echo $entry->getUser()->getUserDisplayName(); ?><br />
        <?php echo convert_dbdate($entry->getEntryTimestamp()); ?><br />
        <?php echo $entry->getCategory()->getCategoryName(); ?>
    </div>
    <div id="entry_content">
        <?php echo $entry->getEntryContent(); ?>
    </div>
</div>
<?php
    if($dbconfigs['DisqusEnabled'] == '1' && $entry->getEntryCommentsEnabled() == '1')
    {
?>
<div id="disqus_head">
    Comments
    <noscript>
        Please Enable JavaScript to view Comments
    </noscript>
</div>
<div id="disqus">
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = '<?php echo $dbconfigs['DisqusShortname']; ?>'; 
        var disqus_identifier = '<?php echo $entry->getEntryId(); ?>';
        var disqus_developer = <?php echo $dbconfigs['DisqusDev']; ?>;
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
</div>
<script type="text/javascript">
    $('#disqus_head').click(function() 
    {
      $('#disqus').fadeToggle('slow', function() {
    // Animation complete.
  });
    });
</script>
<?php 
    }
    else
    {
?>
<div id="disqus_head_disabled">
    Comments are Disabled
</div>
<?php
    }
?>
<br />