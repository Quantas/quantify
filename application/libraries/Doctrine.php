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

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;
 
define('DEBUGGING', FALSE);
 
class Doctrine 
{
 
    public $em = null;
 
    public function __construct()
    {
        // load database configuration and custom config from CodeIgniter
        require APPPATH . 'config/database.php';
 
        // Set up class loading.
        require_once APPPATH . 'libraries/Doctrine/Common/ClassLoader.php';
 
        $doctrineClassLoader = new \Doctrine\Common\ClassLoader('Doctrine', APPPATH . 'libraries');
        $doctrineClassLoader->register();
 
        $entitiesClassLoader = new \Doctrine\Common\ClassLoader('models', rtrim(APPPATH, '/'));
        $entitiesClassLoader->register();
 
        $proxiesClassLoader = new \Doctrine\Common\ClassLoader('Proxies', APPPATH . 'models');
        $proxiesClassLoader->register();
 
        $symfonyClassLoader = new \Doctrine\Common\ClassLoader('Symfony', APPPATH . 'libraries/Doctrine');
        $symfonyClassLoader->register();
        
        $extensionsClassLoader = new \Doctrine\Common\ClassLoader('DoctrineExtensions', APPPATH . 'libraries/Doctrine');
        $extensionsClassLoader->register();
 
        // Choose caching method based on application mode (ENVIRONMENT is defined in /index.php)
        if (ENVIRONMENT == 'development') {
            $cache = new \Doctrine\Common\Cache\ArrayCache;
        } else {
            $cache = new \Doctrine\Common\Cache\ApcCache;
        }
 
        // Set some configuration options
        $config = new Configuration;
 
        // Metadata driver
        $driverImpl = $config->newDefaultAnnotationDriver(APPPATH . 'models');
        $config->setMetadataDriverImpl($driverImpl);
 
        // Caching
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);
 
        // Proxies
        $config->setProxyDir(APPPATH . 'models/Proxies');
        $config->setProxyNamespace('Proxies');
 
        if (ENVIRONMENT == 'development') {
            $config->setAutoGenerateProxyClasses(TRUE);
        } else {
            $config->setAutoGenerateProxyClasses(FALSE);
        }
 
        // SQL query logger
        if (DEBUGGING)
        {
            $logger = new \Doctrine\DBAL\Logging\EchoSQLLogger;
            $config->setSQLLogger($logger);
        }
 
        // Database connection information
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' => $db['default']['username'],
            'password' => $db['default']['password'],
            'host' => $db['default']['hostname'],
            'dbname' => $db['default']['database']
        );
 
        // Create EntityManager
        $this->em = EntityManager::create($connectionOptions, $config);
    }
}