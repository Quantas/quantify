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
<?php  echo '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n"; ?>
    <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
        <channel>
            <atom:link href="<?php echo site_url() . 'feed'; ?>" rel="self" type="application/rss+xml" />
            <title><?php echo $feed_name; ?></title>
            <link><?php echo $feed_url; ?></link>
            <description><?php echo $page_description; ?></description>
            <language><?php echo $page_language; ?></language>
            <?php foreach($entries as $entry): ?>
                <item>
                    <title><?php echo $entry['entry_title']; ?></title>
                    <author><?php echo $entry['user_display_name']; ?></author>
                    <link><?php echo site_url('entry/view/' . $entry['entry_id']) ?></link>
                    <guid><?php echo site_url('entry/view/' . $entry['entry_id']) ?></guid>
                    <description><?php echo character_limiter($entry['content'], 200); ?></description>
                </item>
            <?php endforeach; ?>
        </channel>
    </rss>
