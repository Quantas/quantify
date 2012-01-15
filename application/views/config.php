<?php
echo form_open('admin/edit');
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
        echo '</td><td>';
        echo '<select id="'.$config->getConfigKey().'" name="'.$config->getConfigKey().'">';
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
        echo '</td></tr>';
    }
    else if($config->getConfigKey() == 'Style')
    {
        echo $config->getConfigKey();
        echo '</td><td>';
        echo '<select id="'.$config->getConfigKey().'" name="'.$config->getConfigKey().'">';
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
        echo '</td></tr>';
    }
    else
    {
        echo $config->getConfigKey();
        echo '</td><td>';
        echo '<input id="' . $config->getConfigId() . '" name="'.$config->getConfigKey().'" type="text" value="' . $config->getConfigValue() . '" /><br />';
        echo '</td></tr>';
    }
}
echo '<tr><td colspan="2" style="text-align:right"><input type="submit" name="save" value="Save" class="button" /></td></tr>';
echo '</table>';
echo form_close();
?>

<?php echo form_open('admin/add'); ?>
<table id="admin-config">
    <tr><th colspan="2">Add New Config</th></tr>
    <tr><td><label for="key">Key</label></td>
<td><?php echo form_input('key',set_value('key')); ?></td></tr>
    <tr><td><label for="value">Value</label></td>
<td><?php echo form_input('value',set_value('value')); ?></td></tr>
<tr><td colspan="2" style="text-align:right"><input type="submit" name="add" value="Add" class="button" /></td></tr>
</table>
<?php echo form_close(); ?>

<?php $current = new DateTime('now', new DateTimeZone(get_dbconfig('timezone'))); 
        echo $current->format('m/d/Y H:i:s'); 
        $curtz = $current->getTimezone();
        $curtztrans = $curtz->getTransitions();
        echo '&nbsp;' . $curtztrans[0]['abbr'];
        ?>