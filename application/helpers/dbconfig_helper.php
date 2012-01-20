<?php
use Doctrine\ORM\Query;

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

function getConfigArray()
{
    $CI =& get_instance();
    $em = $CI->doctrine->em;
    $query = $em->createQuery('SELECT c.config_key, c.config_value FROM models\Quantify\Config c');
    $dbconfigs = $query->getResult(Query::HYDRATE_ARRAY);
    
    $configs = array();
    
    foreach($dbconfigs as $config)
    {
        $configs[$config['config_key']] =  $config['config_value'];
    }
    
    return($configs);
}