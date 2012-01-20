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
