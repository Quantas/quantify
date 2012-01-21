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
        $this->_publishSchema();
        $this->_addDefaultData();
        echo 'Good to go';
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
        $config->setKey('SiteName');
        $config->setValue('Your Blog');
        $em->persist($config);
        
        $config1 = new Config;
        $config1->setKey('SiteDesc');
        $config1->setValue('A Place for Stuff');
        $em->persist($config1);
        
        $config2 = new Config;
        $config2->setKey('Timezone');
        $config2->setValue('America/Chicago');
        $em->persist($config2);
        
        $config3 = new Config;
        $config3->setKey('Style');
        $config3->setValue('quantify');
        $em->persist($config3);
        
        $config4 = new Config;
        $config4->setKey('DisqusShortname');
        $config4->setValue('quantifyblog');
        $em->persist($config4);
        
        $config5 = new Config;
        $config5->setKey('DisqusDev');
        $config5->setValue('1');
        $em->persist($config5);
        
        $config6 = new Config;
        $config6->setKey('DisqusEnabled');
        $config6->setValue('1');
        $em->persist($config6);
        
        $perm = new Permission;
        $perm->setPermissionLevel(0);
        $perm->setPermissionName('Administrator');
        $em->persist();
        
        $user = new User;
        $user->setUserName('admin');
        $user->setUserPassword('password');
        $user->UserDisplayName('Admin');
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
