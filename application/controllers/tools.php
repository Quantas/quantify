<?php
use Doctrime\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\SchemaValidator;

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
    
    public function publishSchema()
    {
        $em = $this->doctrine->em;
        $tool = new SchemaTool($em);
        $cmf = $em->getMetadataFactory();
        $classes = $cmf->getAllMetadata();
        $tool->dropDatabase();
        $tool->createSchema($classes);
    }
}
