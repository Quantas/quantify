<div id="nav">
    <ul>
        <li><?php echo anchor('/', 'Home'); ?></li>
        <li><?php echo anchor('/catagory/all', 'Catagories'); ?></li>
        <li><?php echo anchor('/stats', 'Statistics'); ?></li>
        <?php if ($user = models\Quantify\Current_User::user()) 
        {
        ?>
        <li><?php echo anchor('/auth/logout', 'Logout'); ?></li>
        <?php
        }
        else
        {
        ?>
        <li><?php echo anchor('/auth/login', 'Login'); ?></li>
        <?php 
        } 
        ?>
    </ul>
</div>