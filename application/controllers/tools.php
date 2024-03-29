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

use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\SchemaValidator;

use models\Quantify\Config;
use models\Quantify\Permission;
use models\Quantify\User;
use models\Quantify\Entry;
use models\Quantify\Category;

/**
 * This controller is used to validate schema files, create the database, and fill it with data
 *@author Quantas 
 */
class Tools extends CI_Controller
{
    public function validator()
    {
        $entityManager = $this->doctrine->em;

        $validator = new SchemaValidator($entityManager);
        $errors = $validator->validateMapping();

        if (count($errors) > 0) 
        {
            echo var_dump($errors);
        }
        else
        {
            echo "Good to go";
        }
    }
    
    public function setupDatabase()
    {
        try
        {
            try
            {
                if (!empty(getConfigArray()))
                {
                    echo 'Already setup!';
                }
            }
            catch(Exception $e)
            {
                // This is a hack, only run once anyway...
                $this->_publishSchema();
                $this->_addDefaultData();
                echo 'Good to go';
            }
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        
    }
    
    private function _publishSchema()
    {
        $em = $this->doctrine->em;
        $tool = new SchemaTool($em);
        $cmf = $em->getMetadataFactory();
        $classes = $cmf->getAllMetadata();
        $tool->dropDatabase();
        $tool->createSchema($classes);
    }
    
    private function _addDefaultData()
    {
        $em = $this->doctrine->em;
        
        $config = new Config;
        $config->setConfigKey('SiteName');
        $config->setConfigValue('Your Blog');
        $em->persist($config);
        
        $config1 = new Config;
        $config1->setConfigKey('SiteDesc');
        $config1->setConfigValue('A Place for Stuff');
        $em->persist($config1);
        
        $config2 = new Config;
        $config2->setConfigKey('Timezone');
        $config2->setConfigValue('America/Chicago');
        $em->persist($config2);
        
        $config3 = new Config;
        $config3->setConfigKey('Style');
        $config3->setConfigValue('quantify');
        $em->persist($config3);
        
        $config4 = new Config;
        $config4->setConfigKey('DisqusShortname');
        $config4->setConfigValue('quantifyblog');
        $em->persist($config4);
        
        $config5 = new Config;
        $config5->setConfigKey('DisqusDev');
        $config5->setConfigValue('1');
        $em->persist($config5);
        
        $config6 = new Config;
        $config6->setConfigKey('DisqusEnabled');
        $config6->setConfigValue('1');
        $em->persist($config6);
        
        $adminPerm = new Permission;
        $adminPerm->setPermissionLevel(0);
        $adminPerm->setPermissionName('Administrator');
        $em->persist($adminPerm);

        $editorPerm = new Permission;
        $editorPerm->setPermissionLevel(1);
        $editorPerm->setPermissionName('Editor');
        $em->persist($editorPerm);
        
        $userPerm = new Permission;
        $userPerm->setPermissionLevel(2);
        $userPerm->setPermissionName('User');
        $em->persist($userPerm);

        $user = new User;
        $user->setUserName('admin');
        $user->setUserPassword('password');
        $user->setUserDisplayName('Admin');
        $user->setUserEmail('admin@localhost');
        $user->setPermission($adminPerm);
        $em->persist($user);
        
        $cat = new Category;
        $cat->setCategoryName('First Category');
        $em->persist($cat);
        
        $entry = new Entry;
        $entry->setEntryTitle('First Entry');
        $entry->setEntryContent('My First Article');
        $entry->setEntryTimestamp(new DateTime('now', new DateTimeZone('America/Chicago')));
        $entry->setEntryCommentsEnabled(1);
        $entry->setUser($user);
        $entry->setCategory($cat);
        $em->persist($entry);
        
        $em->flush();
    }
}
