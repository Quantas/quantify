<!DOCTYPE html>
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
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>
            <?php echo $dbconfigs['SiteName'];
            ?>
        </title>
        <?php echo link_tag('feed', 'alternate', 'application/rss+xml', $dbconfigs['SiteName'] . ' RSS Feed'); ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/<?php echo $dbconfigs['Style']; ?>.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>resources/lytebox/lytebox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url(); ?>resources/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>resources/jquery/jquery.qtip.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>resources/lytebox/lytebox.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('a[title]').qtip({ style: { tip: true } })
            });
        </script>
</head>
<body>
    <div id="header">
        <div>
            <?php $this->load->view('header'); ?>
        </div>
    </div>
    <div id="shell">
        <div>
            <?php $this->load->view('nav'); ?>
        </div>
        <div id="container">
            <div id="titleDiv">
                <div id="titleLeft"><?php echo $title; ?></div>
                <div id="titleRight">
                    <!--Facebook Like Button --><script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; background:url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top right; } html  </style> <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;" ></a>
                    <!--Twitter tweet Button --><a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    <!--Google +1 Button --><g:plusone size="small" annotation="none"></g:plusone>
                    <script type="text/javascript">
                    (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                    })();
                    </script>
                    <!-- RSS Feed Button --><a href="<?php echo base_url(); ?>feed"><img src="<?php echo base_url(); ?>assets/images/feed-icon.png" alt="RSS Feed"/></a>
                </div>
            </div>
            
                <?php 
                if(isset($sidebar_view))
                {
                ?>
                    <div id="sidebar">
                        <?php $this->load->view($sidebar_view); ?>
                    </div>
                    <div id="main">
                <?php
                }
                else 
                {
                ?>
            <div id="main-noside">
                <?php } ?>
                <?php $this->load->view('banner_messages'); ?>
                <?php if(isset($content_view))
                {
                    $this->load->view($content_view); 
                }
                ?>
            </div>
        </div>
        <div id="bottom">
            Page rendered in {elapsed_time} seconds | &copy;2012 Quantasnet | <?php if ($user = models\Quantify\Current_User::user()) 
                                                                                    {
                                                                                    ?>
                                                                                    <?php echo anchor('admin', 'Admin'); ?> | <?php echo anchor('/auth/logout', 'Logout'); ?>
                                                                                    <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                    ?>
                                                                                    <?php echo anchor('/register/signupForm', 'Register'); ?> | 
                                                                                    <?php echo anchor('/auth/login', 'Login'); ?>
                                                                                    <?php 
                                                                                    } 
                                                                                    ?>
        </div>
    </div>
        <div id="bottom-bottom">Powered By: CodeIgniter | Doctrine | jQuery | jWYSIWYG | CodeMirror | lytebox | PHP | MySQL</div>
    <br />
    <br />
</body>
</html>