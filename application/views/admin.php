<?php
echo form_open('admin/edit');

foreach ($configs as $config) 
{
    if($config->getConfigKey() == 'Timezone')
    {
        echo $config->getConfigKey() . '<select id="'.$config->getConfigKey().'" name="'.$config->getConfigKey().'">';
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
        echo '</select><br />';
    }
    else if($config->getConfigKey() == 'Style')
    {
        echo $config->getConfigKey() . '<select id="'.$config->getConfigKey().'" name="'.$config->getConfigKey().'">';
        foreach($styles as $style)
        {
            if($style == $config->getConfigValue())
            {
                echo '<option SELECTED>' . $style . '</option>';
            }
            else
            {
                echo '<option>' . $style . '</option>';
            }
        }
        echo '</select><br />';
    }
    else
    {
        echo $config->getConfigKey() . '<input id="' . $config->getConfigId() . '" name="'.$config->getConfigKey().'" type="text" value="' . $config->getConfigValue() . '" /><br />';
    }    
}
echo '<br />';
echo form_submit('save', 'Save');
echo form_close();
?>
<br />
<br />

<?php echo form_open('admin/add'); ?>
<table>
    <tr><td><label for="key">Key</label></td>
<td><?php echo form_input('key',set_value('key')); ?></td></tr>
    <tr><td><label for="value">Value</label></td>
<td><?php echo form_input('value',set_value('value')); ?></td></tr>
<tr><td colspan="2"><?php echo form_submit('submit', 'Add'); ?></td></tr>
</table>
<?php echo form_close();
?>