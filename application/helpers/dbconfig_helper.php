<?php

function get_dbconfig($key)
{
    $CI =& get_instance();
    $em = $CI->doctrine->em;
    $config = $em->getRepository('models\Quantify\Config')->findOneBy(array('config_key' => $key));
    
    if($config != false)
    {
        $value = $config->getConfigValue();
    }
    else
    {
        $value = '';
    }
    
    return $value;
}
