<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>
            <?php echo get_dbconfig('SiteName');
            ?>
        </title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/<?php echo $css; ?>.css" />
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
            <div id="content">
                <?php $this->load->view('banner_messages'); ?>
                <?php $this->load->view($content_view); ?>
            </div>
        </div>
        <div id="bottom">
            Page rendered in {elapsed_time} seconds | &copy;2012 Quantasnet | <?php echo anchor('admin', 'Admin'); ?>
        </div>
    </div>
    <br/>
    <br/>
</body>
</html>