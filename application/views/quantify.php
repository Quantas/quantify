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
                <?php echo $title; ?>
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
            Page rendered in {elapsed_time} seconds | &copy;2012 Quantasnet | <?php echo anchor('admin', 'Admin'); ?>
        </div>
    </div>
    <br />
    <br />
</body>
</html>