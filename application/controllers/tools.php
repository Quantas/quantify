<?php
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\SchemaValidator;

use models\Quantify\Config;
use models\Quantify\Permission;
use models\Quantify\User;
use models\Quantify\Entry;
use models\Quantify\Category;

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
            $this->_publishSchema();
            $this->_addDefaultData();
            echo 'Good to go';
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
        
        $perm = new Permission;
        $perm->setPermissionLevel(0);
        $perm->setPermissionName('Administrator');
        $em->persist($perm);
        
        $user = new User;
        $user->setUserName('admin');
        $user->setUserPassword('password');
        $user->setUserDisplayName('Admin');
        $user->setUserEmail('admin@localhost');
        $user->setPermission($perm);
        $em->persist($user);
        
        $cat = new Category;
        $cat->setCategoryName('First Category');
        $em->persist($cat);
        
        $entry = new Entry;
        $entry->setEntryTitle('First Entry');
        $entry->setEntryContent('My First Article');
        $entry->setEntryTimestamp(new DateTime('now', new DateTimeZone('America/Chicago')));
        $entry->setUser($user);
        $entry->setCategory($cat);
        $em->persist($entry);
        
        $em->flush();
    }
}
