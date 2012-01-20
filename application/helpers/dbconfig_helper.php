<?php
use Doctrine\ORM\Query;

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