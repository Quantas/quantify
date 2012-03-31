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

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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