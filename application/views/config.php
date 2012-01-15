<?php
echo form_open('admin/editConfigs');
?>
<table id="admin-config">
    <tr>
        <th colspan="2">
            Configuration
        </th>
    </tr>
<?php
foreach ($configs as $config) 
{
?>
    <tr>
        <td>
    <?php        
    if($config->getConfigKey() == 'Timezone')
    {
        echo $config->getConfigKey();
        ?>
        </td>
        <td>
            
            <select id="<?php echo $config->getConfigKey(); ?>" name="<?php echo $config->getConfigKey(); ?>">
            <?php
            foreach ($tzlist as $tz)
            {
                if($tz == $config->getConfigValue())
                {
                    echo '<option value="' . $tz . '" SELECTED>' . $tz . '</option>';
                }
                else
                {
                    echo '<option value="' . $tz . '">' . $tz . '</option>';
                }
            }
            ?>
            </select>
        </td>
    </tr>
    <?php
    }
    else if($config->getConfigKey() == 'Style')
    {
        echo $config->getConfigKey();
        ?>
        </td>
        <td>
            <select id="<?php echo $config->getConfigKey(); ?>" name="<?php echo $config->getConfigKey(); ?>">
            <?php
            foreach($styles as $style)
            {
                if($style == $config->getConfigValue())
                {
                    echo '<option SELECTED value="' . $style . '">' . basename($style, '.css') . '</option>';
                }
                else
                {
                    echo '<option value="' . $style . '">' . basename($style, '.css') . '</option>';
                }
            }
            ?>
            </select>
        </td>
    </tr>
    <?php
    }
    else
    {
        echo $config->getConfigKey();
        ?>
        </td>
        <td>
            <input id="<?php echo $config->getConfigId(); ?>" name="<?php echo $config->getConfigKey(); ?>" type="text" value="<?php echo $config->getConfigValue(); ?>" />
        </td>
    </tr>
    <?php
    }
}
?>
    <tr>
        <td colspan="2" style="text-align:right">
            <input type="submit" name="save" value="Save" class="button" />
        </td>
    </tr>
</table>
<?php echo form_close(); ?>

<?php echo form_open('admin/addConfig'); ?>
<table id="admin-config">
    <tr>
        <th colspan="2">
            Add New Config
        </th>
    </tr>
    <tr>
        <td>
            <label for="key">Key</label>
        </td>
        <td>
            <?php echo form_input('key',set_value('key')); ?>
        </td>
    </tr>
    <tr>
        <td>
            <label for="value">Value</label>
        </td>
        <td>
            <?php echo form_input('value',set_value('value')); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right">
            <input type="submit" name="add" value="Add" class="button" />
        </td>
    </tr>
</table>
<?php echo form_close(); ?>
