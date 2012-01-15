<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php if ($title != null) { echo $title; } ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/<?php echo $css; ?>" />
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
        <!--<div id="nav">
            
            <div><?php //$this->load->view('menu'); ?></div>
        </div> -->
    </div>
    <div id="shell">
        <div id="container">
        	<div id="content"><?php $this->load->view('banner_messages'); ?>
			<?php $this->load->view($content_view); ?></div>
        </div>
        <div id="bottom">
            <font size="1pt">
            Page rendered in {elapsed_time} seconds | &copy;2011 Quantasnet&nbsp;|&nbsp;<?php echo anchor('about', 'About'); ?>&nbsp;|&nbsp;<a href="http://www.quantasnet.com/bugs">Bugs</a>&nbsp;|&nbsp;<?php echo anchor('blog', 'Blog'); ?>&nbsp;|&nbsp;<?php echo anchor('about/tou', 'Terms of Use'); ?>&nbsp;|&nbsp;<?php echo anchor('about/pp', 'Privacy Policy'); ?>
            </font>
        </div>
    </div>
    <br/>
    <br/>
</body>
</html>